# Flask - Python framework, allows JavaScript to send user data
# to Python code, which uses Swiss Ephemeris to make calculations
from flask import Flask, request, jsonify
from flask_cors import CORS
# Swiss Ephemeris - library based on data from NASA, highly accurate
import swisseph as swe
import datetime

app = Flask(__name__)
# Lets frontend port be different from backend port
CORS(app)

swe.set_ephe_path('.')

ZODIAC_SIGNS = [
   "Aries", "Taurus", "Gemini", "Cancer", 
   "Leo", "Virgo", "Libra", "Scorpio", 
   "Sagittarius", "Capricorn", "Aquarius", "Pisces"
]

# Dictionary for mapping planets to Swiss Ephemeris constants
PLANETS = {
   'Sun': swe.SUN,
   'Moon': swe.MOON,
   'Mercury': swe.MERCURY,
   'Venus': swe.VENUS,
   'Mars': swe.MARS,
   'Jupiter': swe.JUPITER,
   'Saturn': swe.SATURN,
   'Uranus': swe.URANUS,
   'Neptune': swe.NEPTUNE,
   'Pluto': swe.PLUTO
}

@app.route("/api/chart", methods=["POST"])
# Retrieves data from frontend
def chart():
    data = request.json
    date = data['date']
    time = data['time']

    # Converts separate date and time into a single value (Julian Day format)
    dateTimeStr = "{}T{}".format(date, time)
    dt = datetime.datetime.fromisoformat(dateTimeStr)
    julianDay = swe.julday(dt.year, dt.month, dt.day, dt.hour + dt.minute / 60.0)

    # Calculate planetary positions
    result = {}
    for name, planet in PLANETS.items():
        pos, _ = swe.calc_ut(julianDay, planet)
        sign_index = int(pos[0] // 30)
        result[name] = ZODIAC_SIGNS[sign_index]

    # Return results in JSON format
    return jsonify(result)

if __name__ == "__main__":
    app.run(debug=True)
