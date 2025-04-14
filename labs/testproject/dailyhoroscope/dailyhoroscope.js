document.addEventListener("DOMContentLoaded", function() {
  var horoscopeElement = document.getElementById("horoscope");
  
  // check for user data
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
  
  // validate birth date
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

  // get zodiac sign
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

  // api configuration
  const apiConfig = {
    url: "https://best-daily-astrology-and-horoscope-api.p.rapidapi.com/api/Detailed-Horoscope/",
    host: "best-daily-astrology-and-horoscope-api.p.rapidapi.com",
    key: "cd59850f5amshb7ef6d6b9528d44p1cfe5fjsn56ae03ba3144"
  };

  var zodiacSign = getZodiacSign(birthDate);
  
  // show loading state
  horoscopeElement.innerHTML = `
    <div class="loading">
      <p>Loading your personalized horoscope! Please wait...</p>
      <div class="spinner"></div>
    </div>
  `;

  // fetch horoscope
  const apiUrl = `${apiConfig.url}?zodiacSign=${zodiacSign}`;
  const options = {
    method: 'GET',
    headers: {
      'X-RapidAPI-Host': apiConfig.host,
      'X-RapidAPI-Key': apiConfig.key
    }
  };

  fetch(apiUrl, options)
    .then(response => {
      if (!response.ok) throw new Error(`Network response was not ok: ${response.status}`);
      return response.json();
    })
    .then(data => {
      if (data && data.prediction) {
        horoscopeElement.innerHTML = `
          <div class="horoscope-text">
            <h2>${zodiacSign.charAt(0).toUpperCase() + zodiacSign.slice(1)}'s Horoscope</h2>
            <p>${data.prediction}</p>
          </div>
        `;
      } else {
        throw new Error("Invalid API response format");
      }
    })
    .catch(error => {
      console.error("Error fetching horoscope:", error);
      horoscopeElement.innerHTML = `
        <div class="error-message">
          <p>We couldn't connect to our horoscope service at the moment. Please try again later.</p>
        </div>
      `;
    });
});
