//for final upload to github
async function getBirthChart() {
  const input = localStorage.getItem("birthDate");
  if (!input) {
    document.getElementById("chart").innerText = "Please enter your birthdate.";
    return;
  }

  // Fetch the JSON data
  const response = await fetch("./birthchart.json"); // path to your JSON
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

  // Create an HTML table
  let table = "<table><thead><tr><th><strong>Planet</strong></th><th><strong>Zodiac Sign</strong></th></tr></thead><tbody>";
  let output = "";
  for (const planet in chart) {
    table += `<tr><td>${planet}</td><td>${chart[planet]}</td></tr>`;
    output += `<div id="section"><p><strong>Your ${planet} is in ${chart[planet]}.</strong></p>`
    if (planet == "Sun") {
      output += `<p>Your sun sign represents your core identity. It determines
        your ego, identity, and role in life. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Moon") {
      output += `<p>Your moon sign rules your emotions, moods, and sentiments. It typically 
        matches one's view of themself. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Mercury") {
      output += `<p>Your Mercury sign determines how you communicate, think, and learn. Mercury
        is the planet that rules the mind. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Venus") {
      output += `<p>Venus is the planet of love. It indicates how you express affection 
        and the qualities you prefer in others. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Mars") {
      output += `<p>Mars is the planet of aggression. It determines how you assert yourself
        and take action. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Jupiter") {
      output += `<p>Jupiter is one of the social planets, ruling idealism, optimism, and expansion.
        It is centered on philosophy. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Saturn") {
      output += `<p>Saturn is the other social planet, and rules responsibility,
       restrictions, and limits. It also establishes fears and self-discipline. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Uranus") {
      output += `<p>Uranus stays in each sign for seven years, so it rules
        a generation rather than an individual. It is the planet of innovation,
        rebellion, and progress. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Neptune") {
      output += `<p>Neptune stays in each sign for fourteen years, so it also
        stays uniform across a generation. It rules dreams, imagination, and the unconscious.
        As a ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    else if (planet == "Pluto") {
      output += `<p>Pluto stays in each sign for 30 years, so it rules entire groups of people.
        Pluto rules power, intensity, obsession, and control. As a 
        ${chart[planet]}, you are ${signAnalysis.get(chart[planet])}.</p><br>`
    }
    output += `</div>`
  }
  table += "</tbody></table>";

  // Add a delay before showing the content
  await new Promise(resolve => setTimeout(resolve, 1000));
  
  document.getElementById("chart").innerHTML = table;
  document.getElementById("result").innerHTML = output;
}

