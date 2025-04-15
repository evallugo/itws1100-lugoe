// NOTE: Swiss Ephermeris requires EXACTLY HH:MM format for time
// and YYYY-MM-DD format for date

// Page won't reload when submitted
async function updateBirthChart() { 
   try {
   // Contains data from form submitted by user
   const birthDate = localStorage.getItem("birthDate");
   const birthTime = localStorage.getItem("birthTime");
   
   if (!birthDate) {
     document.getElementById("result").innerHTML = "Please set your birth date in your profile first.";
     return;
   }
   
   if (!birthTime) {
     document.getElementById("result").innerHTML = "Please set your birth time in your profile first.";
     return;
   }
 
   // Send data to Flask for Swiss Ephemeris calculations
   const calculations = await fetch("http://localhost:5000/api/chart", {
     method: "POST",
     headers: { "Content-Type": "application/json" },
     body: JSON.stringify({
       date: birthDate,
       time: birthTime
     })
   });
   
   // Preserves order of planets instead of alphabetical ordering
   const planetOrder = [
    "Sun", "Moon", "Mercury", "Venus",
    "Mars", "Jupiter", "Saturn", "Uranus", 
    "Neptune", "Pluto"
  ];

   const signAnalysis = new Map([
    ["Aries", "implusive, bold and energetic. You are a passionate and confident leader with immense determination."],
    ["Taurus", "reliable, patient, and stubborn. You have a grounded and realistic perspective in life, and always stick to your choices."],
    ["Gemini", "perceptive, analytical, and have a great sense of humor. You are versatile, a combination of introverted and extroverted."],
    ["Cancer", "intuitive, sentimental, and loyal. You are deeply connected to your emotions and have a strong sense of home and family."],
    ["Leo", "confident, dramatic, and creative. You have a natural flair for leadership and a desire to be recognized for your talents."],
    ["Virgo", "analytical, practical, and detail-oriented. You have a strong work ethic and a desire for perfection in everything you do."],
    ["Libra", "diplomatic, social, and fair-minded. You have a natural ability to see both sides of a situation and seek harmony in relationships."],
    ["Scorpio", "passionate, resourceful, and determined. You have a deep emotional intensity and a desire to uncover hidden truths."],
    ["Sagittarius", "optimistic, adventurous, and philosophical. You have a love for freedom and a desire to explore new horizons."],
    ["Capricorn", "ambitious, disciplined, and responsible. You have a strong sense of duty and a desire to achieve long-term success."],
    ["Aquarius", "innovative, independent, and humanitarian. You have a unique perspective and a desire to make the world a better place."],
    ["Pisces", "intuitive, artistic, and compassionate. You have a deep connection to the spiritual realm and a desire to help others."]
   ]);

  let tableHTML = `
      <table>
        <thead>
          <tr>
            <th>Planet</th>
            <th>Zodiac Sign</th>
          </tr>
        </thead>
        <tbody>
    `;
  
   // Output results
   const result = await calculations.json();
   let output = "";
   for (const planet of planetOrder) {
      // Add to chart
      tableHTML += `
      <tr>
        <td><strong>${planet}</strong></td>
        <td>${result[planet]}</td>
      </tr>
      `;

      // Add to analysis
      output += `<p><strong>${planet}</strong> is in <strong>${result[planet]}</strong></p>`;
      if (planet == "Sun") {
        output += '<p>Your sun sign represents your core identity. It determines' +
        ' your ego, identity, and role in life. As a ' + result[planet] +
        ', you are ' + signAnalysis.get(result[planet]) + '</p>';
      }
   }
   tableHTML += `</tbody></table>`;
   document.getElementById("table").innerHTML = tableHTML;
   document.getElementById("result").innerHTML = output;
   }

   catch (error) {
      console.error("Chart error:", error);
      document.getElementById("result").innerHTML = "Something went wrong fetching your chart. Please make sure the Flask server is running.";
   }
}

// Initialize birth chart when page loads
document.addEventListener("DOMContentLoaded", function() {
    // Check if user is logged in
    var userId = localStorage.getItem('userId');
    if (!userId) {
        // Redirect to homepage if not logged in
        window.location.href = "../homepage/home.html";
        return;
    }
    
    // Try to update birth chart
    updateBirthChart();
});