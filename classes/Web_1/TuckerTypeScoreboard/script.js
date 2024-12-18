/*  Final Game Project
    Cole Vaughn

    This is my implementation of a typing game:

    +=+=+=+=+=+=+= Gameplay =+=+=+=+=+=+=+=+

    The buttons at the top are overall self documenting, but if not:

        Random- sets gamestyle to random, generates random words
        Sentence- sets gamestyle to sentence, generates random sentence
        10- sets gamestyle to random, sets wordcount to 10 words
        30- sets gamestyle to random, sets wordcount to 30 words
        50- sets gamestyle to random, sets wordcount to 50 words
        NewGame- generates a new game with previous games settings

    DONT: click any buttons while clock is ticking

    To play:
        
        -click onto the area where the words are to set your cursor
        -begin typing, trying to correctly type all letters
        -backspace will function normally
        -space will bring you to the next word

    Game Finished:

        -Words Per Min and Accuracy will be displayed where the timer was located
        -press any of the buttons to generate a new game
        -your personal high score will be recorded and saved as a cookie (1 year expiration)

*/

//list of words and sentences to generate
let words = ["the", "of", "to", "and", "a", "in", "is", "it", "you", "that", "he", "was", "for", "on", "are", "with", "as", "I", "his", "they", "be", "at", "one", "have", "this", "from", "or", "had", "by", "not", "word", "but", "what", "some", "we", "can", "out", "other", "were", "all", "there", "when", "up", "use", "your", "how", "said", "an", "each", "she", "which", "do", "their", "time", "if", "will", "way", "about", "many", "then", "them", "write", "would", "like", "so", "these", "her", "long", "make", "thing", "see", "him", "two", "has", "look", "more", "day", "could", "go", "come", "did", "number", "sound", "no", "most", "people", "my", "over", "know", "water", "than", "call", "first", "who", "may", "down", "side", "been", "now", "find", "any", "new", "work", "part", "take", "get", "place", "made", "live", "where", "after", "back", "little", "only", "round", "man", "year", "came", "show", "every", "good", "me", "give", "our", "under", "name", "very", "through", "just", "form", "sentence", "great", "think", "say", "help", "low", "line", "differ", "turn", "cause", "much", "mean", "before", "move", "right", "boy", "old", "too", "same", "tell", "does", "set", "three", "want", "air", "well", "also", "play", "small", "end", "put", "home", "read", "hand", "port", "large", "spell", "add", "even", "land", "here", "must", "big", "high", "such", "follow", "act", "why", "ask", "men", "change", "went", "light", "kind", "off", "need", "house", "picture", "try", "us", "again", "animal", "point", "mother", "world", "near", "build", "self", "earth", "father", "head", "stand", "own", "page", "should", "country", "found", "answer", "school", "grow", "study", "still", "learn", "plant", "cover", "food", "sun", "four", "between", "state", "keep", "eye", "never", "last", "let", "thought", "city", "tree", "cross", "farm", "hard", "start", "might", "story", "saw", "far", "sea", "draw", "left", "late", "run", "don't", "while", "press", "close", "night", "real", "life", "few", "north", "open", "seem", "together", "next", "white", "children", "begin", "got", "walk", "example", "ease", "paper", "group", "always", "music", "those", "both", "mark", "often", "letter", "until", "mile", "river", "car", "feet", "care", "second", "book", "carry", "took", "science", "eat", "room", "friend", "began", "idea", "fish", "mountain", "stop", "once", "base", "hear", "horse", "cut", "sure", "watch", "color", "face", "wood", "main", "enough", "plain", "girl", "usual", "young", "ready", "above", "ever", "red", "list", "though", "feel", "talk", "bird", "soon", "body", "dog", "family", "direct", "pose", "leave", "song", "measure", "door", "product", "black", "short", "numeral", "class", "wind", "question", "happen", "complete", "ship", "area", "half", "rock", "order", "fire", "south", "problem", "piece", "told", "knew", "pass", "since", "top", "whole", "king", "space", "heard", "best", "hour", "better", "true", "during", "hundred", "five", "remember", "step", "early", "hold", "west", "ground", "interest", "reach", "fast", "verb", "sing", "listen", "six", "table", "travel", "less", "morning", "ten", "simple", "several", "vowel", "toward", "war", "lay", "against", "pattern", "slow", "center", "love", "person", "money", "serve", "appear", "road", "map", "rain", "rule", "govern", "pull", "cold", "notice", "voice", "unit", "power", "town", "fine", "certain", "fly", "fall", "lead", "cry", "dark", "machine", "note", "wait", "plan", "figure", "star", "box", "noun", "field", "rest", "correct", "able", "pound", "done", "beauty", "drive", "stood", "contain", "front", "teach", "week", "final", "gave", "green", "oh", "quick", "develop", "ocean", "warm", "free", "minute", "strong", "special", "mind", "behind", "clear", "tail", "produce", "fact", "street", "inch", "multiply", "nothing", "course", "stay", "wheel", "full", "force", "blue", "object", "decide", "surface", "deep", "moon", "island", "foot", "system", "busy", "test", "record", "boat", "common", "gold", "possible", "plane", "stead", "dry", "wonder", "laugh", "thousand", "ago", "ran", "check", "game", "shape", "equate", "hot", "miss", "brought", "heat", "snow", "tire", "bring", "yes", "distant", "fill", "east", "paint", "language", "among", "grand", "ball", "yet", "wave", "drop", "heart", "am", "present", "heavy", "dance", "engine", "position", "arm", "wide", "sail", "material", "size", "vary", "settle", "speak", "weight", "general", "ice", "matter", "circle", "pair", "include", "divide", "syllable", "felt", "perhaps", "pick", "sudden", "count", "square", "reason", "length", "represent", "art", "subject", "region", "energy", "hunt", "probable", "bed", "brother", "egg", "ride", "cell", "believe", "fraction", "forest", "sit", "race", "window", "store", "summer", "train", "sleep", "prove", "lone", "leg", "exercise", "wall", "catch", "mount", "wish", "sky", "board", "joy", "winter", "sat", "written", "wild", "instrument", "kept", "glass", "grass", "cow", "job", "edge", "sign", "visit", "past", "soft", "fun", "bright", "gas", "weather", "month", "million", "bear", "finish", "happy", "hope", "flower", "clothe", "strange", "gone", "jump", "baby", "eight", "village", "meet", "root", "buy", "raise", "solve", "metal", "whether", "push", "seven", "paragraph", "third", "shall", "held", "hair", "describe", "cook", "floor", "either", "result", "burn", "hill", "safe", "cat", "century", "consider", "type", "law", "bit", "coast", "copy", "phrase", "silent", "tall", "sand", "soil", "roll", "temperature", "finger", "industry", "value", "fight", "lie", "beat", "excite", "natural", "view", "sense", "ear", "else", "quite", "broke", "case", "middle", "kill", "son", "lake", "moment", "scale", "loud", "spring", "observe", "child", "straight", "consonant", "nation", "dictionary", "milk", "speed", "method", "organ", "pay", "age", "section", "dress", "cloud", "surprise", "quiet", "stone", "tiny", "climb", "cool", "design", "poor", "lot", "experiment", "bottom", "key", "iron", "single", "stick", "flat", "twenty", "skin", "smile", "crease", "hole", "trade", "melody", "trip", "office", "receive", "row", "mouth", "exact", "symbol", "die", "least", "trouble", "shout", "except", "wrote", "seed", "tone", "join", "suggest", "clean", "break", "lady", "yard", "rise", "bad", "blow", "oil", "blood", "touch", "grew", "cent", "mix", "team", "wire", "cost", "lost", "brown", "wear", "garden", "equal", "sent", "choose", "fell", "fit", "flow", "fair", "bank", "collect", "save", "control", "decimal", "gentle", "woman", "captain", "practice", "separate", "difficult", "doctor", "please", "protect", "noon", "whose", "locate", "ring", "character", "insect", "caught", "period", "indicate", "radio", "spoke", "atom", "human", "history", "effect", "electric", "expect", "crop", "modern", "element", "hit", "student", "corner", "party", "supply", "bone", "rail", "imagine", "provide", "agree", "thus", "capital", "won't", "chair", "danger", "fruit", "rich", "thick", "soldier", "process", "operate", "guess", "necessary", "sharp", "wing", "create", "neighbor", "wash", "bat", "rather", "crowd", "corn", "compare", "poem", "string", "bell", "depend", "meat", "rub", "tube", "famous", "dollar", "stream", "fear", "sight", "thin", "triangle", "planet", "hurry", "chief", "colony", "clock", "mine", "tie", "enter", "major", "fresh", "search", "send", "yellow", "gun", "allow", "print", "dead", "spot", "desert", "suit", "current", "lift", "rose", "continue", "block", "chart", "hat", "sell", "success", "company", "subtract", "event", "particular", "deal", "swim", "term", "opposite", "wife", "shoe", "shoulder", "spread", "arrange", "camp", "invent", "cotton", "born", "determine", "quart", "nine", "truck", "noise", "level", "chance", "gather", "shop", "stretch", "throw", "shine", "property", "column", "molecule", "select", "wrong", "gray", "repeat", "require", "broad", "prepare", "salt", "nose", "plural", "anger", "claim", "continent", "oxygen", "sugar", "death", "pretty", "skill", "women", "season", "solution", "magnet", "silver", "thank", "branch", "match", "suffix", "especially", "fig", "afraid", "huge", "sister", "steel", "discuss", "forward", "similar", "guide", "experience", "score", "apple", "bought", "led", "pitch", "coat", "mass", "card", "band", "rope", "slip", "win", "dream", "evening", "condition", "feed", "tool", "total", "basic", "smell", "valley", "nor", "double", "seat", "arrive", "master", "track", "parent", "shore", "division", "sheet", "substance", "favor", "connect", "post", "spend", "chord", "fat", "glad", "original", "share", "station", "dad", "bread", "charge", "proper", "bar", "offer", "segment", "slave", "duck", "instant", "market", "degree", "populate", "chick", "dear", "enemy", "reply", "drink", "occur", "support", "speech", "nature", "range", "steam", "motion", "path", "liquid", "log", "meant", "quotient", "teeth", "shell", "neck"];
let sentences = [["The", "quick", "brown", "fox", "jumps", "over", "a", "lazy", "dog's", "back"],
                 ["Jinxed", "wizards", "pluck", "quartz", "from", "my", "big,", "cozy", "fireplace,", "Vixen"],
                 ["Sphinx", "of", "black", "quartz,", "judge", "my", "vow.", "Pack", "my", "box", "with", "five", "dozen", "liquor", "jugs", "and", "a", "dozen", "extra", "cozy", "muffins"],
                 ["Jumping", "quickly,", "the", "lazy", "fox", "grabbed", "a", "zesty,", "mixed", "bag", "of", "savory,", "flavorful", "herbs,", "providing", "exquisite", "joy", "to", "my", "taste", "buds"],
                 ["Jazzed", "xylophones,", "quirky", "bumblebees,", "and", "fluid", "foxgloves", "provide", "a", "whimsical,", "exciting", "backdrop,", "while", "the", "vixen", "jumps", "over", "lazy,", "majestic", "cliffs,", "exploring", "the", "enigmatic,", "dazzling", "fjords", "by", "the", "cozy", "warmth", "of", "the", "fireplace"],
                 ["In", "a", "quiet", "village,", "a", "curious", "cat", "named", "Whiskers", "discovered", "a", "magical", "portal", "hidden", "in", "the", "ancient", "library.", "Venturing", "through,", "Whiskers", "embarked", "on", "a", "thrilling", "adventure,", "meeting", "eccentric", "characters", "and", "solving", "mysteries"]
                ]

let sentence = ["Jinxed", "wizards", "pluck", "ivy", "from", "the", "big", "quilt", "of", "a", "frozen", "dog,", "baffling", "vexed,", "gray-haired", "judges"];

const wordsCount = words.length;
const sentenceCount = sentence.length;
let timer = 0;
const gameTime = timer * 1000;
let gameWords = 30;
window.timer = null;
window.gameStart = null;
window.pauseTime = 0;
let wordsDone = 0;
let gameStyle = 0;
const loadingBar = document.getElementById('loading-bar');
let loadNum = 0;
const leftBox = (document.getElementById('game')).getBoundingClientRect().left;


newGame();


//this is where basically the entire game is played, using the keydown event
//I will attempt to put comments where parts that might be non-self explanatory are located
document.getElementById('game').addEventListener('keydown', ev => {
    //this section is looking for teh current word and current letter within current word
    //it also checks for various issues
    const key = ev.key;
    const currentLetter = document.querySelector('.letter.current');
    const expected = currentLetter?.innerHTML || ' ';
    const currentWord = document.querySelector('.word.current'); 
    const isLetter = key.length === 1 && key !== ' ';
    const isSpace = key === ' ';
    const isBackspace = key === 'Backspace';
    const isFirstLetter = currentLetter === currentWord.firstChild;
    const isExtra = currentWord.querySelector('.letter.incorrect-extra');

    //starts the timer if it hasnt been started and updates it accordingly
    if (!window.timer && isLetter) {
        window.timer = setInterval(() => {
            if (!window.gameStart) {
                window.gameStart = (new Date()).getTime();
            }
            const currentTime = (new Date()).getTime();
            const secs = (currentTime - window.gameStart) / 1000;


            document.getElementById('info').innerHTML = Math.round(secs) + '';

        }, 1000);
    }
    if (document.querySelector('#game.over')) {
        return;
    }

    //The first case, that the keyboard event is a letter
    if (isLetter) {
        if (currentLetter) {
            //set the letter to be correct or incorrect and move current along
            addClass(currentLetter, key === expected ? 'correct' : 'incorrect');
            removeClass(currentLetter, 'current');
            if (currentLetter.nextSibling) {
                addClass(currentLetter.nextSibling, 'current');
            }
        } else {
            //if there are too many letters append them, and give them the incorrect extra id
            const incorrectLetter = document.createElement('span');
            incorrectLetter.innerHTML = key;
            incorrectLetter.className = 'letter';
            currentWord.appendChild(incorrectLetter); 
            addClass(currentWord.lastChild, 'incorrect-extra');
         
        }
    }

    //The second case, that the keyboard event is a space
    if (isSpace) {
        //skip word if space isnt correct
        if (expected !== ' ') {
            const lettersToInvalidate = [...document.querySelectorAll('.word.current .letter:not(.correct)')];
            lettersToInvalidate.forEach(letter => {
                addClass(letter, 'incorrect');
            });
        }

        //move onto the next word, if you cant remain at the end of the current word
        try {
            removeClass(currentWord, 'current');
            addClass(currentWord.nextSibling, 'current');
            ++wordsDone;
            incrementLoad();
            if (currentLetter) {
            removeClass(currentLetter, 'current');
            }
            addClass(currentWord.nextSibling.firstChild, 'current');
        } catch (error) {
            addClass(currentWord.lastChild, 'current');
            addClass(currentWord, 'current');
            ++wordsDone;
            incrementLoad();

        }
    }
    //The third case, that the keyboard event is a backspace
    if (isBackspace) {
        //if its an extra appended letter, remove it
        if (isExtra) {
            currentWord.removeChild(currentWord.lastChild);            
        } else if (currentLetter && isFirstLetter) {
          //first letter then move to previous word
          const isWierdCase = currentWord.previousSibling.querySelector('.letter.incorrect-extra');
          if (isWierdCase) {
            console.log("encountered Wierd Case");
            currentWord.previousSibling.removeChild(currentWord.previousSibling.lastChild); 
            removeClass(currentWord, 'current');
            addClass(currentWord.previousSibling, 'current');
            removeClass(currentLetter, 'current');    
            
            --wordsDone;
          decrementLoad();
          } else {
          removeClass(currentWord, 'current');
          addClass(currentWord.previousSibling, 'current');
          removeClass(currentLetter, 'current');
          addClass(currentWord.previousSibling.lastChild, 'current');
          removeClass(currentWord.previousSibling.lastChild, 'incorrect');
          removeClass(currentWord.previousSibling.lastChild, 'correct');

          --wordsDone;
          decrementLoad();
          }
        } else if (currentLetter && !isFirstLetter) {
          // move back one letter, invalidate letter

            removeClass(currentLetter, 'current');
            addClass(currentLetter.previousSibling, 'current');
            removeClass(currentLetter.previousSibling, 'incorrect');
            removeClass(currentLetter.previousSibling, 'correct');

        } else if (!currentLetter) {
          addClass(currentWord.lastChild, 'current');
          removeClass(currentWord.lastChild, 'incorrect');
          removeClass(currentWord.lastChild, 'correct');
        }
      }


    //find location cursor needs to move to and move it
    const nextLetter = document.querySelector('.letter.current');
    const nextWord = document.querySelector('.word.current');
    const cursor = document.getElementById('cursor');
    cursor.style.top = (nextLetter || nextWord).getBoundingClientRect().top + 2 + 'px';
    cursor.style.left = (nextLetter || nextWord).getBoundingClientRect()[nextLetter ? 'left' : 'right'] + 'px';
    
    
    //checking wether or not the game is finished, with various odd conditions
    if (gameStyle == 0) {
        if (wordsDone == (gameWords - 1) && currentLetter == currentWord.lastChild || wordsDone >= gameWords) {
            incrementLoad();
            gameOver();
        }
     }
    

    if (gameStyle == 1) {
       if (wordsDone == (sentence.length - 1) && currentLetter == currentWord.lastChild || wordsDone >= sentence.length) {
            incrementLoad();    
            gameOver();
        } 
    }
    

});

document.getElementById('newGameBtn').addEventListener('click', () => {
    newGame();
});

function addClass(el, name) {
    el.className += ' '+name;
}

function removeClass(el, name) {
    el.className = el.className.replace(name, '');
}

//set different options within game
function choose(button){
    gameWords = button;
    console.log(gameWords);
    gameStyle = 0;
    newGame();
}

function chooseWords(button){
    gameStyle = button;
    console.log(gameStyle)
    newGame();
}

//gets the correct words to use in the WPM calculation
function getCorrectWords() {
    const words = [...document.querySelectorAll('.word')];
    const lastTypedWord = document.querySelector('.word.current');
    const lastTypedWordIndex = words.indexOf(lastTypedWord) + 1;
    const typedWords = words.slice(0, lastTypedWordIndex);
    const currentTime = (new Date()).getTime();
    const secs = Math.round((currentTime - window.gameStart) / 1000);
    const realSecs = (currentTime - window.gameStart) / 1000;

    console.log(realSecs);

    const correctWords = typedWords.filter(word => {
      const letters = [...word.children];
      const incorrectLetters = letters.filter(letter => letter.className.includes('incorrect'));
      const correctLetters = letters.filter(letter => letter.className.includes('correct'));
      return incorrectLetters.length === 0 && correctLetters.length === letters.length;
    });

    return Math.round((correctWords.length / realSecs) * 60);
}

//similar to above
function getAccuracy() {
    const letters = [...document.querySelectorAll('.letter')];
    const correctLetters = [...document.querySelectorAll('.letter.correct')];

    console.log(letters.length); 
    console.log(correctLetters.length); 


    return Math.round((correctLetters.length/letters.length) * 100);
  }

function newGame() {
    let randSentence = Math.ceil(Math.random() * (sentences.length -1));
    sentence = sentences[randSentence];
    removeClass(document.getElementById('game'), 'over');
    wordsDone = 0;
    timer = 0;
    window.timer = null;
    window.gameStart = null;
    document.getElementById('words').innerHTML = '';
    loadNum = 0;
    updateLoadingBar();

    if (gameStyle == 0) {
        for (let i = 0; i < gameWords; i++) {
            document.getElementById('words').innerHTML += formatWord(randomWord());
        }
    } else {
        for (let i = 0; i < sentence.length; i++) {
            document.getElementById('words').innerHTML += formatWord(sentence[i]);
        }
    }

    //sets the first letter of the first word and the cursor
    addClass(document.querySelector('.word'), 'current');
    addClass(document.querySelector('.letter'), 'current');

    document.getElementById('info').innerHTML = (gameTime / 1000) + '';
    cursor.style.top = 289+ 'px';
    cursor.style.left = leftBox + 'px';
}

function randomWord() {
    const randomIndex = Math.ceil(Math.random() * wordsCount);
    return words[randomIndex - 1];
}

function formatWord(word) {
    return `<div class="word"><span class="letter">${word.split('').join('</span><span class="letter">')}</span></div>`;
}

function gameOver() {
    clearInterval(window.timer);
    addClass(document.getElementById('game'), 'over');
    const result = getCorrectWords();
    const accuracy = getAccuracy();
    console.log(getCorrectWords());
    document.getElementById('info').innerHTML = `WPM: ${result} ACC: ${accuracy}%`;
    updateButton();
}

function incrementLoad() {
    let x = 0;
    if (gameStyle == 0) {
        x = gameWords;
    } else {
        x = sentence.length;
    }

    if (loadNum < x) {
        loadNum++;
        updateLoadingBar();
        console.log(loadNum);
    }
}

function decrementLoad() {
    if (loadNum > 0) {
        loadNum--;
        updateLoadingBar();
        console.log(loadNum);

    }
}

function updateLoadingBar() {
    let progress;
    if (gameStyle == 0) {
        progress = (loadNum / gameWords) * 100;
    } else {
        progress = (loadNum / sentence.length) * 100;
    }
    loadingBar.style.width = progress + '%';
}

//+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=+=
//Cookie stuff like the code we used in class

function writeCookie(name, value, expDate, path, domain, secure) {
    if (name && value) {
        let cStr = name + "=" + encodeURIComponent(value);
        if (expDate) cStr += ";expires=" + expDate.toUTCString();
        if (path) cStr += ";path=" + path;
        if (domain) cStr += ";domain=" + domain;
        if (secure) cStr += ";secure=" + secure;
        document.cookie = cStr;
    }
}

function readCookie() {
    let fields = {};

    if (document.cookie) {
        let cookieList = document.cookie.split("; ");

        for (items of cookieList) {
            let cookie = items.split("=");
            let name = cookie[0];
            let value = decodeURIComponent(cookie[1]);
            fields[name] = value;
        }
        return fields;
    }
}

function checkCookie() {
    let expire = new Date();
    expire.setMonth(expire.getMonth() + 12);
    const templateMax = "WPM: 100 ACC: 100%";
    const templateMin = "WPM: 0 ACC: 0%";
    let infoS = document.getElementById("info").innerHTML;
    let WPMstring = infoS.substring(5, 9);
    console.log(WPMstring);
    let WPM;
    let record;
    let currentRecord = document.getElementById("record").innerHTML;
    currentRecord = currentRecord.substring(22, 26);

    for (let index = 0; index < WPMstring.length; index++) {
        if (WPMstring[index] == " ") {
            WPM = WPMstring.substring(0, index);
            // console.log(WPM);

        } 
    }

    for (let index = 0; index < currentRecord.length; index++) {
        if (currentRecord[index] == " ") {
            record = currentRecord.substring(0, index);
            // console.log(record);

        } 
    }

    let WPMint = parseInt(WPM);
    let recordInt = parseInt(record);
    let NA = document.getElementById("record").innerHTML;

    if (WPMint > recordInt || NA == "Personal Record: N/A") { 
        if (infoS.length >= templateMin.length && infoS.length <= templateMax.length ) {
            if (document.cookie) {
                deleteCookies();
                writeCookie("info_Data", infoS, expire);
            } else {
                writeCookie("info_Data", infoS, expire);
            }
        }
    }
}

function checkCookieLoad() {
        if (document.cookie) {
            let CookieData = readCookie();
            record.innerHTML = "Personal Record: " + CookieData.info_Data;
        } 
}

function deleteCookies() {
    let expired = new Date();

    if (document.cookie) {
        let CookieData = readCookie();
        let info = CookieData.info_Data;
        if (info != "" && info != null) {  
            writeCookie("info_Data", info, expired);
        }
    }
}

function updateButton() {
    checkCookie();
    checkCookieLoad(); 
}
