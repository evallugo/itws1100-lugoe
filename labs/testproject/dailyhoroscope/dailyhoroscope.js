document.addEventListener("DOMContentLoaded", function() {
  var horoscopeElement = document.getElementById("horoscope");
  
  //check if user data exists
  var userId = localStorage.getItem('userId');
  var birthDateStr = localStorage.getItem('birthDate');
  
  if (!birthDateStr) {
    horoscopeElement.innerHTML = 'Please set up your birth date in your profile first! <a href="../profile/profile.html">Go to Profile</a>';
    return;
  }
  
  //ensure the date is in the correct format for parsing
  var birthDate;
  try {
    birthDate = new Date(birthDateStr);
    if (isNaN(birthDate.getTime())) {
      horoscopeElement.textContent = "There was an issue with your birth date. Please update it in your profile.";
      return;
    }
  } catch (e) {
    console.error("Error parsing date:", e);
    horoscopeElement.textContent = "There was an issue with your birth date. Please update it in your profile.";
    return;
  }

  //function to calculate the zodiac sign from the birth date
  function getZodiacSign(date) {
    var day = date.getDate();
    var month = date.getMonth() + 1;

    if ((month === 1 && day >= 20) || (month === 2 && day <= 18)) return "aquarius";
    else if ((month === 2 && day >= 19) || (month === 3 && day <= 20)) return "pisces";
    else if ((month === 3 && day >= 21) || (month === 4 && day <= 19)) return "aries";
    else if ((month === 4 && day >= 20) || (month === 5 && day <= 20)) return "taurus";
    else if ((month === 5 && day >= 21) || (month === 6 && day <= 20)) return "gemini";
    else if ((month === 6 && day >= 21) || (month === 7 && day <= 22)) return "cancer";
    else if ((month === 7 && day >= 23) || (month === 8 && day <= 22)) return "leo";
    else if ((month === 8 && day >= 23) || (month === 9 && day <= 22)) return "virgo";
    else if ((month === 9 && day >= 23) || (month === 10 && day <= 22)) return "libra";
    else if ((month === 10 && day >= 23) || (month === 11 && day <= 21)) return "scorpio";
    else if ((month === 11 && day >= 22) || (month === 12 && day <= 21)) return "sagittarius";
    else if ((month === 12 && day >= 22) || (month === 1 && day <= 19)) return "capricorn";
  }

  //fallback horoscope messages in case the API fails
  const fallbackHoroscopes = {
    "aquarius": "Today is a day of innovation and intellectual growth. Trust your intuition and embrace new ideas.",
    "pisces": "Your creative energy is flowing today. Take time to reflect and connect with your inner self.",
    "aries": "Your natural leadership abilities are highlighted today. Take initiative and move forward with confidence.",
    "taurus": "Focus on stability and growth today. Your practical approach will lead to success.",
    "gemini": "Communication is your strength today. Express yourself clearly and listen to others.",
    "cancer": "Emotional connections are important today. Nurture your relationships and trust your feelings.",
    "leo": "Your charisma is at its peak today. Share your talents and inspire others.",
    "virgo": "Attention to detail will serve you well today. Organize your thoughts and plans.",
    "libra": "Balance and harmony are your focus today. Seek peace in your relationships.",
    "scorpio": "Your intuition is strong today. Trust your instincts and embrace transformation.",
    "sagittarius": "Adventure and learning await you today. Expand your horizons and seek new experiences.",
    "capricorn": "Your determination will lead to success today. Stay focused on your goals."
  };

  var zodiacSign = getZodiacSign(birthDate);
  var today = new Date().toISOString().slice(0, 10);
  
  // Add loading animation
  horoscopeElement.innerHTML = `
    <div class="loading">
      <p>Loading your personalized horoscope...</p>
      <div class="spinner"></div>
    </div>
  `;

  const apiUrl = `https://best-daily-astrology-and-horoscope-api.p.rapidapi.com/api/Detailed-Horoscope/?zodiacSign=${zodiacSign}`;
  
  const options = {
    method: 'GET',
    headers: {
      'X-RapidAPI-Host': 'best-daily-astrology-and-horoscope-api.p.rapidapi.com',
      'X-RapidAPI-Key': 'cd59850f5amshb7ef6d6b9528d44p1cfe5fjsn56ae03ba3144'
    }
  };

  // Set a timeout for the API call
  const timeoutDuration = 8000; // 8 seconds
  const timeoutPromise = new Promise((_, reject) => {
    setTimeout(() => reject(new Error('Request timed out')), timeoutDuration);
  });

  // Race between the fetch and the timeout
  Promise.race([
    fetch(apiUrl, options),
    timeoutPromise
  ])
    .then(response => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then(data => {
      if (data && data.prediction) {
        // Personalize the horoscope with user-specific additions
        var personalAdditions = [
          "Remember, your unique spark lights up every room you enter.",
          "Embrace your individuality and let it shine through today.",
          "Your personal energy is unmatched—make the most of this vibrant day.",
          "Today is all about harnessing your distinct talents; let them guide you.",
          "Your journey is uniquely yours; trust your instincts and celebrate who you are."
        ];
        
        var seed = getSeed(userId || 'defaultUser', today);
        var index = seed % personalAdditions.length;
        var personalMessage = personalAdditions[index];
        
        var finalMessage = `For ${zodiacSign.charAt(0).toUpperCase() + zodiacSign.slice(1)}: ${data.prediction} ${personalMessage}`;
        horoscopeElement.textContent = finalMessage;
      } else {
        throw new Error("Invalid API response format");
      }
    })
    .catch(error => {
      console.error("Error fetching horoscope:", error);
      // Use fallback horoscope if API fails
      var fallbackMessage = fallbackHoroscopes[zodiacSign] || "Today is a day of possibilities. Trust your instincts and embrace the journey ahead.";
      var personalAdditions = [
        "Remember, your unique spark lights up every room you enter.",
        "Embrace your individuality and let it shine through today.",
        "Your personal energy is unmatched—make the most of this vibrant day.",
        "Today is all about harnessing your distinct talents; let them guide you.",
        "Your journey is uniquely yours; trust your instincts and celebrate who you are."
      ];
      
      var seed = getSeed(userId || 'defaultUser', today);
      var index = seed % personalAdditions.length;
      var personalMessage = personalAdditions[index];
      
      var finalMessage = `For ${zodiacSign.charAt(0).toUpperCase() + zodiacSign.slice(1)}: ${fallbackMessage} ${personalMessage}`;
      horoscopeElement.textContent = finalMessage;
    });
});
