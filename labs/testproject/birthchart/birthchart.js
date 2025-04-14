// NOTE: Swiss Ephermeris requires EXACTLY HH:MM format for time
// and YYYY-MM-DD format for date

// Page won't reload when submitted
async function updateBirthChart() { 
   try {
   // Contains data from form submitted by user
   const data = {
     date: localStorage.getItem("birthDate"),
     time: localStorage.getItem("birthTime"),
   };
 
   // Send data to Flask for Swiss Ephemeris calculations
   const calculations = await fetch("http://localhost:5000/api/chart", {
     method: "POST",
     headers: { "Content-Type": "application/json" },
     body: JSON.stringify(data)
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
    ["Cancer", "intuitive, sentimental, and loyal. "]
   ])

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
        ', you are '
      }
   }
   tableHTML += `</tbody></table>`;
   document.getElementById("table").innerHTML = tableHTML;
   document.getElementById("result").innerHTML = output;
   }

   catch (error) {
      console.error("Chart error:", error);
      document.getElementById("result").innerHTML = "Something went wrong fetching your chart.";
   }

};

window.addEventListener("DOMContentLoaded", updateBirthChart);