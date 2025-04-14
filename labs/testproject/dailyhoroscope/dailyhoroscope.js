document.addEventListener("DOMContentLoaded", function() {
  //retrieve user data from localStorage
  var userId = localStorage.getItem('userId') || 'defaultUser';
  //expect the birthDate to be stored in a proper format (preferably YYYY-MM-DD)
  var birthDateStr = localStorage.getItem('birthDate') || '1995-06-15';
  
  //ensure the date is in the correct format for parsing
  var birthDate;
  try {
    //try to parse the date string
    birthDate = new Date(birthDateStr);
    
    //check if the date is valid
    if (isNaN(birthDate.getTime())) {
      console.error("Invalid date format:", birthDateStr);
      birthDate = new Date('1995-06-15'); //Fallback to default date
    }
  } catch (e) {
    console.error("Error parsing date:", e);
    birthDate = new Date('1995-06-15'); //Fallback to default date
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
  var today = new Date().toISOString().slice(0, 10); //Format: "YYYY-MM-DD"
  var horoscopeElement = document.getElementById("horoscope");
  horoscopeElement.textContent = "Loading your personalized horoscope...";

  //aztro API uses a POST request; build the URL using the zodiac sign
  var apiUrl = "https://aztro.sameerkumar.website/?sign=" + encodeURIComponent(zodiacSign) + "&day=today";

  //call the aztro API to get the base horoscope message.
  fetch(apiUrl, { method: "POST" })
    .then(function(response) {
      if (!response.ok) {
        throw new Error("Network response was not ok.");
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

      var seed = getSeed(userId, today);
      var index = seed % personalAdditions.length;
      var personalMessage = personalAdditions[index];

      //combine the base aztro message with your personalized addition
      var finalMessage = "For " + zodiacSign + ": " + baseMessage + " " + personalMessage;
      horoscopeElement.textContent = finalMessage;
    })
    .catch(function(error) {
      console.error("Error fetching horoscope:", error);
      //Use fallback horoscope if API fails
      var fallbackMessage = fallbackHoroscopes[zodiacSign] || "Today is a day of possibilities. Trust your instincts and embrace the journey ahead.";
      var personalAdditions = [
        "Remember, your unique spark lights up every room you enter.",
        "Embrace your individuality and let it shine through today.",
        "Your personal energy is unmatched—make the most of this vibrant day.",
        "Today is all about harnessing your distinct talents; let them guide you.",
        "Your journey is uniquely yours; trust your instincts and celebrate who you are."
      ];
      
      var seed = getSeed(userId, today);
      var index = seed % personalAdditions.length;
      var personalMessage = personalAdditions[index];
      
      var finalMessage = "For " + zodiacSign + ": " + fallbackMessage + " " + personalMessage;
      horoscopeElement.textContent = finalMessage;
    });
});
