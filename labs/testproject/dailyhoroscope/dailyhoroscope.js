document.addEventListener("DOMContentLoaded", function() {
  var horoscopeElement = document.getElementById("horoscope");
  
  // Check if user data exists
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

    if ((month === 1 && day >= 20) || (month === 2 && day <= 18)) return "Aquarius";
    else if ((month === 2 && day >= 19) || (month === 3 && day <= 20)) return "Pisces";
    else if ((month === 3 && day >= 21) || (month === 4 && day <= 19)) return "Aries";
    else if ((month === 4 && day >= 20) || (month === 5 && day <= 20)) return "Taurus";
    else if ((month === 5 && day >= 21) || (month === 6 && day <= 20)) return "Gemini";
    else if ((month === 6 && day >= 21) || (month === 7 && day <= 22)) return "Cancer";
    else if ((month === 7 && day >= 23) || (month === 8 && day <= 22)) return "Leo";
    else if ((month === 8 && day >= 23) || (month === 9 && day <= 22)) return "Virgo";
    else if ((month === 9 && day >= 23) || (month === 10 && day <= 22)) return "Libra";
    else if ((month === 10 && day >= 23) || (month === 11 && day <= 21)) return "Scorpio";
    else if ((month === 11 && day >= 22) || (month === 12 && day <= 21)) return "Sagittarius";
    else if ((month === 12 && day >= 22) || (month === 1 && day <= 19)) return "Capricorn";
  }

  //fallback horoscope messages in case the API fails
  const fallbackHoroscopes = {
    "Aquarius": "Today is a day of innovation and intellectual growth. Trust your intuition and embrace new ideas.",
    "Pisces": "Your creative energy is flowing today. Take time to reflect and connect with your inner self.",
    "Aries": "Your natural leadership abilities are highlighted today. Take initiative and move forward with confidence.",
    "Taurus": "Focus on stability and growth today. Your practical approach will lead to success.",
    "Gemini": "Communication is your strength today. Express yourself clearly and listen to others.",
    "Cancer": "Emotional connections are important today. Nurture your relationships and trust your feelings.",
    "Leo": "Your charisma is at its peak today. Share your talents and inspire others.",
    "Virgo": "Attention to detail will serve you well today. Organize your thoughts and plans.",
    "Libra": "Balance and harmony are your focus today. Seek peace in your relationships.",
    "Scorpio": "Your intuition is strong today. Trust your instincts and embrace transformation.",
    "Sagittarius": "Adventure and learning await you today. Expand your horizons and seek new experiences.",
    "Capricorn": "Your determination will lead to success today. Stay focused on your goals."
  };

  var zodiacSign = getZodiacSign(birthDate);
  var today = new Date().toISOString().slice(0, 10);
  horoscopeElement.textContent = "Loading your personalized horoscope...";

  // Add loading animation
  horoscopeElement.innerHTML = `
    <div class="loading">
      <p>Loading your personalized horoscope...</p>
      <div class="spinner"></div>
    </div>
  `;

  //aztro API uses a POST request
  var apiUrl = "https://aztro.sameerkumar.website/?sign=" + encodeURIComponent(zodiacSign) + "&day=today";

  // Set a timeout for the API call
  const timeoutDuration = 5000; // 5 seconds
  const timeoutPromise = new Promise((_, reject) => {
    setTimeout(() => reject(new Error('Request timed out')), timeoutDuration);
  });

  // Race between the fetch and the timeout
  Promise.race([
    fetch(apiUrl, { 
      method: "POST",
      headers: {
        'Accept': 'application/json'
      }
    }),
    timeoutPromise
  ])
    .then(function(response) {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then(function(data) {
      //aztro returns an object with a "description" field
      var baseMessage = data.description;

      //personalize the output further using a deterministic seed based on userId and today's date
      function getSeed(userId, dateStr) {
        var seed = 0;
        var combined = userId + dateStr;
        for (var i = 0; i < combined.length; i++) {
          seed += combined.charCodeAt(i);
        }
        return seed;
      }

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

      //combine the base aztro message with your personalized addition
      var finalMessage = "For " + zodiacSign + ": " + baseMessage + " " + personalMessage;
      horoscopeElement.textContent = finalMessage;
    })
    .catch(function(error) {
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
      
      var finalMessage = "For " + zodiacSign + ": " + fallbackMessage + " " + personalMessage;
      horoscopeElement.textContent = finalMessage;
    });
});
