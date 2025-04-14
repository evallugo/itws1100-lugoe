document.addEventListener("DOMContentLoaded", function() {
  var horoscopeElement = document.getElementById("horoscope");
  
  //check if user data exists
  var userId = localStorage.getItem('userId');
  var birthDateStr = localStorage.getItem('birthDate');
  
  if (!birthDateStr) {
    horoscopeElement.innerHTML = `
      <div class="error-message">
        <p>Please set up your birth date in your profile first!</p>
        <a href="../profile/profile.html" class="profile-link">Go to Profile</a>
      </div>
    `;
    return;
  }
  
  //ensure the date is in the correct format for parsing
  var birthDate;
  try {
    birthDate = new Date(birthDateStr);
    if (isNaN(birthDate.getTime())) {
      horoscopeElement.innerHTML = `
        <div class="error-message">
          <p>There was an issue with your birth date format. Please update it in your profile using YYYY-MM-DD format.</p>
          <a href="../profile/profile.html" class="profile-link">Update Profile</a>
        </div>
      `;
      return;
    }
  } catch (e) {
    console.error("Error parsing date:", e);
    horoscopeElement.innerHTML = `
      <div class="error-message">
        <p>There was an issue with your birth date. Please update it in your profile.</p>
        <a href="../profile/profile.html" class="profile-link">Update Profile</a>
      </div>
    `;
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

  function getSeed(userId, dateStr) {
    // Get just the date part for daily consistency
    const today = new Date();
    const dailyComponent = today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate();
    
    var seed = dailyComponent; // Start with date-based seed
    var combined = (userId || 'defaultUser') + dateStr;
    for (var i = 0; i < combined.length; i++) {
      seed += combined.charCodeAt(i);
    }
    return seed;
  }

  // Expanded message variations for more uniqueness
  const personalityTraits = [
    "creative", "intuitive", "determined", "compassionate", "energetic",
    "analytical", "peaceful", "adventurous", "wise", "charismatic"
  ];

  const actions = [
    "embrace new opportunities", "trust your instincts", "take bold steps",
    "nurture relationships", "explore new ideas", "maintain balance",
    "focus on growth", "share your wisdom", "express yourself freely",
    "build strong foundations"
  ];

  const outcomes = [
    "leading to unexpected joy", "bringing positive change",
    "creating lasting happiness", "opening new doors",
    "strengthening your spirit", "enhancing your journey",
    "manifesting your dreams", "aligning with your destiny",
    "attracting good fortune", "deepening your understanding"
  ];

  function generateUniqueMessage(seed) {
    // Use the seed to select different components
    const trait = personalityTraits[seed % personalityTraits.length];
    const action = actions[(seed * 13) % actions.length]; // Use prime numbers for better distribution
    const outcome = outcomes[(seed * 17) % outcomes.length];
    
    return `Your ${trait} nature guides you to ${action}, ${outcome}.`;
  }

  const positiveAffirmations = [
    "Remember, your unique spark lights up every room you enter.",
    "Embrace your individuality and let it shine through today.",
    "Your personal energy is unmatched—make the most of this vibrant day.",
    "Today is all about harnessing your distinct talents; let them guide you.",
    "Your journey is uniquely yours; trust your instincts and celebrate who you are.",
    "The universe conspires in your favor today.",
    "Your potential knows no bounds—embrace it fully.",
    "Every moment brings new opportunities for growth.",
    "Your presence makes a difference in ways you may not realize.",
    "The stars align to support your deepest aspirations."
  ];

  var zodiacSign = getZodiacSign(birthDate);
  var today = new Date().toISOString().slice(0, 10);
  
  // Add loading animation
  horoscopeElement.innerHTML = `
    <div class="loading">
      <p>Loading your personalized horoscope! Please wait...</p>
      <div class="spinner"></div>
    </div>
  `;

  // Log the API request details for debugging
  console.log('Making API request for zodiac sign:', zodiacSign);
  
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
      console.log('API Response status:', response.status);
      if (!response.ok) {
        throw new Error(`Network response was not ok: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      console.log('API Response data:', data);
      if (data && data.prediction) {
        const seed = getSeed(userId || 'defaultUser', today);
        const uniqueMessage = generateUniqueMessage(seed);
        const affirmation = positiveAffirmations[(seed * 23) % positiveAffirmations.length];
        
        const finalMessage = `For ${zodiacSign.charAt(0).toUpperCase() + zodiacSign.slice(1)}: ${data.prediction} ${uniqueMessage} ${affirmation}`;
        horoscopeElement.textContent = finalMessage;
      } else {
        console.error('Invalid API response format:', data);
        throw new Error("Invalid API response format");
      }
    })
    .catch(error => {
      console.error("Error fetching horoscope:", error);
      
      console.log('Error details:', {
        message: error.message,
        zodiacSign: zodiacSign,
        apiUrl: apiUrl
      });

      const seed = getSeed(userId || 'defaultUser', today);
      const uniqueMessage = generateUniqueMessage(seed);
      const affirmation = positiveAffirmations[(seed * 23) % positiveAffirmations.length];
      
      const fallbackMessage = fallbackHoroscopes[zodiacSign] || "Today is a day of possibilities. Trust your instincts and embrace the journey ahead.";
      
      horoscopeElement.innerHTML = `
        <div class="error-message">
          <p>We couldn't connect to our horoscope service at the moment. Here's your backup horoscope:</p>
        </div>
        <div class="horoscope-text">
          For ${zodiacSign.charAt(0).toUpperCase() + zodiacSign.slice(1)}: ${fallbackMessage} ${uniqueMessage} ${affirmation}
        </div>
      `;
    });
});
