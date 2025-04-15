async function getBirthChart() {
  const input = localStorage.getItem("birthDate");
  if (!input) {
    document.getElementById("chart").innerText = "Please enter your birthdate.";
    return;
  }

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
<<<=======
  // Fetch the JSON data
  const response = await fetch("./ephemeris_data.json"); // path to your JSON
  const data = await response.json();

  // Look up the birth date
  const chart = data[input];
  const signAnalysis = new Map([
    ["Aries", "implusive, bold and energetic. You are a passionate and confident leader with immense determination"],
    ["Taurus", "reliable, patient, and stubborn. You have a grounded and realistic perspective in life, and always stick to your choices"],
    ["Gemini", "perceptive, analytical, and have a great sense of humor. You are versatile, a combination of introverted and extroverted"],
    ["Cancer", "intuitive, sentimental, and loyal. You are very loyal and empathize with other people's pain and suffering"],
    ["Leo", "creative, passionate, and warm-hearted. You are a natural born leader and difficult to resist"],
    ["Virgo", "hardworking, practical, and kind. You are methodical in everything you do and leave little to chance"],
    ["Libra", "cooperative, diplomatic, and gracious. You are peaceful and long for balance, leading you to chase justice and equality"],
    ["Scorpio", "brave, powerful, and resourceful. You are dedicated and fearless in the face of challenges"],
    ["Sagittarius", "generous, idealistic, and philosphical. You motivated to wander the world and search for the meaning of life"],
    ["Capricorn", "motivated, self-disciplined, and responsible. You possess an inner state of independence enabling significant progress professionally"],
    ["Aquarius", "original, humanitarian, and progressive. You are a highly intellectual, deep thinker, and see people without prejudice"],
    ["Pisces", "artistic, intuitive, and gentle. You are selfless and always willing to help others, and expect nothing in return"]
   ])

  if (!chart) {
    document.getElementById("chart").innerText = "No data available for that date.";
    return;
  }

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
  // Create an HTML table
  let table = "<table><thead><tr><th>Planet</th><th>Zodiac Sign</th></tr></thead><tbody>";
  let output = "";
  for (const planet in chart) {
    table += `<tr><td>${planet}</td><td>${chart[planet]}</td></tr>`;
    output += `<div id="section"><p>Your ${planet} is in ${chart[planet]}.<div>`
    if (planet == "Sun") {
      output += `<p>Your sun sign represents your core identity. It determines
        your ego, identity, and role in life. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Moon") {
      output += `<p>Your moon sign rules your emotions, moods, and sentiments. It typically 
        matches one's view of themself. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Mercury") {
      output += `<p>Your Mercury sign determines how you communicate, think, and learn. Mercury
        is the planet that rules the mind. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Venus") {
      output += `<p>Venus is the planet of love. It indicates how you express affection 
        and the qualities you prefer in others. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Mars") {
      output += `<p>Mars is the planet of aggression. It determines how you assert yourself
        and take action. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Jupiter") {
      output += `<p>Jupiter one of the social planets, ruling idealism, optimism, and expansion.
        It is centered on philosophy. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Saturn") {
      output += `<p>Saturn is the other social planet, and rules responsibility,
       restrictions, and limits. It also establishes fears and self-discipline. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Uranus") {
      output += `<p>Uranus stays in each sign for seven years, so it rules
        a generation rather than an individual. It is the planet of innovation,
        rebellion, and progress. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Neptune") {
      output += `<p>Neptune stays in each sign for fourteen years, so it also
        stays uniform across a generation. It rules dreams, imagination, and the unconscious.
        As a ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.<p>`
    }
    else if (planet == "Pluto") {
      output += `<p>Pluto stays in each sign for 30 years, so it rules entire groups of people.
        Pluto rules power, intensity, obsession, and control. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.`
    }
  }
  table += "</tbody></table>";

  document.getElementById("chart").innerHTML = table;
  document.getElementById("result").innerHTML = output;
}
