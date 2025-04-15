document.addEventListener("DOMContentLoaded", function() {
  var horoscopeElement = document.getElementById("horoscope");
  
  // check for user data
  var userId = localStorage.getItem('userId');
  var birthDateStr = localStorage.getItem('birthDate');
  
  // clear any existing content and show disclaimer if no birth date
  if (!birthDateStr) {
    localStorage.removeItem('lastHoroscope'); // clear any stored horoscope
    horoscopeElement.innerHTML = `
      <div class="error-message">
        <p>Welcome to your Daily Horoscope! To receive your personalized reading, please set up your birth date in your profile first.</p>
        <p>This information is necessary to calculate your zodiac sign and provide accurate astrological insights.</p>
        <a href="../profile/profile.html" class="profile-link">Set Up Profile</a>
      </div>
    `;
    return;
  }
  
  // validate birth date
  var birthDate;
  try {
    birthDate = new Date(birthDateStr);
    if (isNaN(birthDate.getTime())) {
      localStorage.removeItem('lastHoroscope'); // clear any stored horoscope
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
    localStorage.removeItem('lastHoroscope'); // clear any stored horoscope
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

  var zodiacSign = getZodiacSign(birthDate);
  
  // show loading state
  horoscopeElement.innerHTML = `
    <div class="loading">
      <p>Loading your personalized horoscope! Please wait...</p>
      <div class="spinner"></div>
    </div>
  `;

  // Get horoscope text based on zodiac sign
  function getHoroscopeText(sign) {
    const horoscopes = {
      aries: "Today is a day of new beginnings for you, Aries. Your natural leadership abilities will be highlighted, and you'll find yourself taking charge of situations. Trust your instincts and don't be afraid to take risks. Your energy levels are high, so use this to your advantage.",
      taurus: "Taurus, today brings opportunities for financial growth and stability. Your practical approach to life will serve you well. Focus on your long-term goals and avoid impulsive decisions. Take time to enjoy the simple pleasures of life.",
      gemini: "Communication is key for you today, Gemini. Your curiosity will lead you to interesting conversations and new information. Be mindful of spreading yourself too thin - focus on quality over quantity in your interactions.",
      cancer: "Emotional connections are highlighted for you today, Cancer. Your intuition is strong, so trust your feelings. Take time to nurture yourself and those you care about. Home and family matters may require your attention.",
      leo: "Your creative energy is at its peak today, Leo. Express yourself boldly and don't be afraid to shine. Your natural charisma will attract positive attention. Focus on projects that allow you to showcase your talents.",
      virgo: "Today is a good day for organization and attention to detail, Virgo. Your analytical mind will help you solve problems efficiently. Take care of practical matters and don't forget to take breaks to avoid overthinking.",
      libra: "Balance and harmony are your focus today, Libra. Your diplomatic skills will be valuable in resolving conflicts. Focus on creating beauty and peace in your surroundings. Trust your ability to make fair decisions.",
      scorpio: "Your intensity and passion are heightened today, Scorpio. Trust your instincts and don't be afraid to dig deep into matters that interest you. Your transformative energy can help you overcome obstacles.",
      sagittarius: "Adventure and learning await you today, Sagittarius. Your optimistic outlook will attract positive opportunities. Be open to new experiences and don't be afraid to expand your horizons. Your philosophical nature will guide you well.",
      capricorn: "Today brings opportunities for career advancement, Capricorn. Your disciplined approach will help you achieve your goals. Focus on long-term success and don't be afraid to take on responsibilities. Your practical wisdom will serve you well.",
      aquarius: "Innovation and originality are your strengths today, Aquarius. Your unique perspective will help you solve problems in creative ways. Connect with like-minded individuals and don't be afraid to think outside the box.",
      pisces: "Your intuition and creativity are heightened today, Pisces. Trust your inner voice and allow yourself to dream big. Take time for spiritual practices and artistic expression. Your compassionate nature will help others."
    };
    
    return horoscopes[sign] || "Your horoscope is not available at this time.";
  }

  // Simulate loading delay for better user experience
  setTimeout(function() {
    const horoscopeText = getHoroscopeText(zodiacSign);
    
    horoscopeElement.innerHTML = `
      <div class="horoscope-text">
        <h2>${zodiacSign.charAt(0).toUpperCase() + zodiacSign.slice(1)}'s Horoscope</h2>
        <p>${horoscopeText}</p>
      </div>
    `;
    
    // Store the horoscope for potential caching
    localStorage.setItem('lastHoroscope', JSON.stringify({
      sign: zodiacSign,
      text: horoscopeText,
      date: new Date().toDateString()
    }));
  }, 1000); // 1 second delay to show loading animation
});
