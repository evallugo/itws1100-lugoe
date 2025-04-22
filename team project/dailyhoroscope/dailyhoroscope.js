//initialize page when dom content is loaded
document.addEventListener('DOMContentLoaded', () => {
    const userId = localStorage.getItem('userId');
    const birthDate = localStorage.getItem('birthDate');

    //redirect to homepage if user is not logged in
    if (!userId) {
        window.location.href = "../homepage/home.html";
        return;
    }

    //check if birth date is set
    if (!birthDate) {
        document.getElementById('horoscope').innerHTML = `
            <div class="error-message">
                <p>Please set up your profile with a birth date first.</p>
                <a href="../profile/profile.html" class="profile-link">Set Up Profile</a>
            </div>
        `;
        return;
    }
  
    //validate birth date format
    const birthDateRegex = /^\d{4}-\d{2}-\d{2}$/;
    if (!birthDateRegex.test(birthDate)) {
        document.getElementById('horoscope').innerHTML = `
            <div class="error-message">
                <p>Invalid birth date format. Please update your profile.</p>
                <a href="../profile/profile.html" class="profile-link">Update Profile</a>
            </div>
        `;
        return;
    }

    //calculate zodiac sign based on birth date
    const date = new Date(birthDate);
    const month = date.getMonth() + 1;
    const day = date.getDate();

    let zodiacSign = '';
    if ((month === 3 && day >= 21) || (month === 4 && day <= 19)) zodiacSign = 'aries';
    else if ((month === 4 && day >= 20) || (month === 5 && day <= 20)) zodiacSign = 'taurus';
    else if ((month === 5 && day >= 21) || (month === 6 && day <= 20)) zodiacSign = 'gemini';
    else if ((month === 6 && day >= 21) || (month === 7 && day <= 22)) zodiacSign = 'cancer';
    else if ((month === 7 && day >= 23) || (month === 8 && day <= 22)) zodiacSign = 'leo';
    else if ((month === 8 && day >= 23) || (month === 9 && day <= 22)) zodiacSign = 'virgo';
    else if ((month === 9 && day >= 23) || (month === 10 && day <= 22)) zodiacSign = 'libra';
    else if ((month === 10 && day >= 23) || (month === 11 && day <= 21)) zodiacSign = 'scorpio';
    else if ((month === 11 && day >= 22) || (month === 12 && day <= 21)) zodiacSign = 'sagittarius';
    else if ((month === 12 && day >= 22) || (month === 1 && day <= 19)) zodiacSign = 'capricorn';
    else if ((month === 1 && day >= 20) || (month === 2 && day <= 18)) zodiacSign = 'aquarius';
    else zodiacSign = 'pisces';

    //generate unique seed for consistent daily horoscopes
    const today = new Date();
    const dateSeed = today.getFullYear() * 10000 + (today.getMonth() + 1) * 100 + today.getDate();
    const userSeed = userId.split('').reduce((acc, char) => acc + char.charCodeAt(0), 0);
    const uniqueSeed = dateSeed + userSeed;
    
    //generate and display horoscope
    const horoscopeText = generateDailyHoroscope(zodiacSign, uniqueSeed);
    
    setTimeout(() => {
        document.getElementById('horoscope').innerHTML = `
            <div class="horoscope-content">
                <h2>${zodiacSign.charAt(0).toUpperCase() + zodiacSign.slice(1)}'s Horoscope</h2>
                <p>${horoscopeText}</p>
            </div>
        `;
    }, 1000);
});

//generate seeded random number
function seededRandom(seed) {
    const x = Math.sin(seed++) * 10000;
    return x - Math.floor(x);
}

//select random element from array using seed
function pickRandom(array, seed) {
    return array[Math.floor(seededRandom(seed) * array.length)];
}

//generate personalized horoscope text
function generateDailyHoroscope(zodiacSign, seed) {
    //define zodiac sign characteristics and content
    const aspects = {
        aries: {
            strengths: ['leadership', 'courage', 'determination', 'confidence', 'enthusiasm', 'optimism', 'honesty', 'passion'],
            activities: ['taking initiative', 'starting new projects', 'physical exercise', 'competitive activities', 'leadership roles'],
            advice: ['trust your instincts', 'take calculated risks', 'channel your energy positively', 'embrace new beginnings', 'lead by example']
        },
        taurus: {
            strengths: ['reliability', 'patience', 'practicality', 'devotion', 'responsibility', 'stability'],
            activities: ['financial planning', 'creative projects', 'gardening', 'cooking', 'art appreciation'],
            advice: ['stay grounded', 'focus on long-term goals', 'trust your practical judgment', 'appreciate the simple things', 'build security']
        },
        gemini: {
            strengths: ['adaptability', 'versatility', 'intellect', 'communicative', 'witty', 'curious'],
            activities: ['learning new skills', 'social networking', 'writing', 'short trips', 'mental challenges'],
            advice: ['stay focused on priorities', 'communicate clearly', 'embrace versatility', 'gather information', 'share your ideas']
        },
        cancer: {
            strengths: ['intuition', 'emotional intelligence', 'nurturing', 'protective', 'sympathetic', 'loyal'],
            activities: ['home improvement', 'family time', 'emotional reflection', 'nurturing relationships', 'creative expression'],
            advice: ['trust your feelings', 'create emotional security', 'nurture important relationships', 'honor your needs', 'express yourself']
        },
        leo: {
            strengths: ['creativity', 'generosity', 'cheerfulness', 'leadership', 'confidence', 'loyalty'],
            activities: ['creative projects', 'social events', 'leadership roles', 'performance', 'self-expression'],
            advice: ['shine your light', 'express yourself authentically', 'be generous with others', 'take center stage', 'follow your heart']
        },
        virgo: {
            strengths: ['analyticalness', 'practicalility', 'diligence', 'organization', 'helpfulness', 'reliability'],
            activities: ['organizing', 'problem-solving', 'detailed work', 'health routines', 'helping others'],
            advice: ['focus on the details', 'maintain healthy routines', 'offer your expertise', 'stay practical', 'refine your skills']
        },
        libra: {
            strengths: ['diplomatic', 'fair-minded', 'social', 'gracious', 'cooperative', 'artistic'],
            activities: ['social gatherings', 'artistic pursuits', 'meditation', 'partnership work', 'decoration'],
            advice: ['seek balance', 'maintain harmony', 'collaborate with others', 'make fair decisions', 'appreciate beauty']
        },
        scorpio: {
            strengths: ['passionate', 'resourceful', 'powerful', 'observant', 'magnetic', 'resilient'],
            activities: ['research', 'investigation', 'transformation', 'strategic planning', 'deep conversations'],
            advice: ['trust your intuition', 'embrace transformation', 'use your power wisely', 'dig deeper', 'stay focused']
        },
        sagittarius: {
            strengths: ['optimistic', 'adventurous', 'philosophical', 'straightforward', 'enthusiastic', 'generous'],
            activities: ['travel', 'learning', 'teaching', 'outdoor activities', 'expanding horizons'],
            advice: ['seek adventure', 'expand your knowledge', 'stay optimistic', 'be honest', 'explore new perspectives']
        },
        capricorn: {
            strengths: ['responsible', 'disciplined', 'self-control', 'ambitious', 'patient', 'practical'],
            activities: ['career advancement', 'goal setting', 'organization', 'building foundations', 'long-term planning'],
            advice: ['stay focused on goals', 'maintain discipline', 'build solid foundations', 'take responsibility', 'plan carefully']
        },
        aquarius: {
            strengths: ['progressive', 'original', 'independent', 'humanitarian', 'inventive', 'intellectual'],
            activities: ['innovation', 'social causes', 'group projects', 'technological pursuits', 'networking'],
            advice: ['think outside the box', 'embrace uniqueness', 'contribute to community', 'innovate', 'stay true to yourself']
        },
        pisces: {
            strengths: ['intuition', 'artisticness', 'gentleness', 'compassion', 'adaptablility', 'spirituality'],
            activities: ['artistic expression', 'meditation', 'helping others', 'spiritual practices', 'creative projects'],
            advice: ['trust your intuition', 'express creativity', 'show compassion', 'maintain boundaries', 'follow your dreams']
        }
    };

    const sign = aspects[zodiacSign];
    const strength = pickRandom(sign.strengths, seed);
    const activity = pickRandom(sign.activities, seed + 1);
    const advice = pickRandom(sign.advice, seed + 2);

    const aspects_of_life = ['career', 'relationships', 'personal growth', 'creativity', 'health', 'communication'];
    const focused_aspect = pickRandom(aspects_of_life, seed + 3);

    const energies = ['The stars align to boost your', 'The cosmic energy enhances your', 'Planetary movements amplify your', 'The universe supports your'];
    const energy = pickRandom(energies, seed + 4);

    //construct final horoscope message
    return `${energy} ${strength} today, particularly in matters of ${focused_aspect}. 
    This is an excellent time for ${activity}. Remember to ${advice} as you navigate through the day's opportunities and challenges. 
    Your natural ${pickRandom(sign.strengths, seed + 5)} will serve you well in achieving your goals.`;
}
