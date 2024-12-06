<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classify the Target Image</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .imagecontainer {
            margin-top: 30px;
        }
        input {
            margin-top: 10px;
            padding: 5px;
        }
        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .feedback {
            margin-top: 20px;
            font-weight: bold;
        }
        img {
            max-width: 300px;
            display: block;
            margin-top: 20px;
        }
        .formula {
            margin-top: 20px;
            font-size: 18px;
            background-color: transparent;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap');

        body,html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Roboto Mono', monospace;
            color: #00ffcc;
            text-align: center;
            background: linear-gradient(135deg, #141e30, #243b55, #4b79a1, #00c853, #ff007f, #ff4081);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            box-shadow: inset 0 0 30px rgba(255, 255, 255, 0.1);
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        h1,h2,h3,p {
            text-shadow: 0 0 20px rgba(0, 255, 204, 0.6), 0 0 30px rgba(0, 255, 204, 0.6);
        }

        #gameContainer {
            width: 1800px;
            height: auto;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        #imageDisplay {
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        #targetImage {
            max-width: 180px;
            max-height: 180px;
            object-fit: contain;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        #gameScene {
    width: 90%; /* Make the width responsive */
    max-width: 800px; /* Max width for larger screens */
    height: 300px; /* Fixed height or adjust as needed */
    margin: auto; /* Centers horizontally within flex container */
    border: 2px solid #333;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 10px;
    backdrop-filter: blur(15px);
    box-sizing: border-box;
    box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.2); /* Subtle inner shadow */
}

        #stats {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            font-weight: bold;
        }

        #message {
            text-align: center;
            font-size: 1.2em;
            margin: 10px 0;
            min-height: 30px;
            color: #fff;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.5s;
        }

        .modal h2 {
            color: #4CAF50;
            margin-top: 0;
        }

        .modal button {
            padding: 10px 20px;
            font-size: 16px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.3s;
        }

        .modal button:hover {
            background: #45a049;
        }

        .celebration {
            position: fixed;
            pointer-events: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 999;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #f00;
            animation: confetti-fall 3s linear forwards;
        }

        .modal-content {
            background: rgba(20, 20, 20, 0.95);
            padding: 30px;
            border: none;
            width: 90%;
            position: fixed;
            left: 50%;
            transform: translateX(-50%);
            bottom: 5%;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 255, 204, 0.5);
            color: #00ffcc;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 1.2em;
            text-align: justify;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }

        .character {
            width: 100px;
            margin-right: 20px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        #start-level-btn {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #start-level-btn:hover {
            background-color: #45a049;
        }

        #game-area {
            display: none;
        }

        #colorContainer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300px;
        }

        #colorImage,
        #selectedColorImage {
            width: 300px;
            height: 300px;
            background-color: rgb(0, 0, 0);
        }

        .modal-overlay-result {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.5s;
        }

        button {
            background-color: #0f3460;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1a1a2e;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
                /* Overlay for the settings modal (background shade) */
        .settings-modal-overlay {
            position: fixed; /* Fix position to cover the entire screen */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7); /* Semi-transparent background */
            display: flex; /* Using flexbox to center the modal */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            z-index: 1000; /* Ensure the modal is on top */
        }

        /* Modal container */
        .settings-modal {
            background: linear-gradient(135deg, #1a1a1a, #2b2b2b); /* Gradient background */
            color: white; /* Text color */
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 300px; /* Set fixed width for the modal */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Shadow effect */
            position: relative; /* For the close button positioning */
        }

        /* Close button inside the modal */
        .settings-modal .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: white;
            cursor: pointer;
            background: transparent;
            border: none;
        }

        /* Hover effect for the close button */
        .settings-modal .close:hover {
            color: #ff0000; /* Red color on hover */
        }

        /* Buttons inside the modal */
        .settings-modal button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: none;
            background-color: #007bff; /* Button background */
            color: white; /* Button text color */
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Hover effect on the buttons */
        .settings-modal button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }


        #settingsIcon {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            z-index: 1000;
            padding: 10px;
        }

        #settingsIcon:hover {
            transform: scale(1.1);
        }

        .gameover-modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }

        .gameover-modal-content {
            background: linear-gradient(135deg, rgba(0, 0, 50, 0.8), rgba(0, 0, 100, 0.6));
            margin: 15% auto;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            width: 300px;
            text-align: center;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
        }

        .modal-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        .modal-image {
            width: 70%;
            height: auto;
            position: absolute;
            transform: translateY(-50%) scaleX(-1);
            position: absolute;
            top: 70%;
            right: 0%;
        }

        #scoreModal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        
        .container {
        display: flex;
        justify-content: center;  
        align-items: center;     
        height: 100vh;           
        }

                /* Settings Button Styling */
        .settings-button {
            font-size: 24px; /* Larger font size for the icon */
            width: 60px; /* Increased width */
            height: 60px; /* Increased height */
            border-radius: 50%; /* Circular button */
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add some shadow for a 3D effect */
            cursor: pointer;
            transition: transform 0.2s ease, background-color 0.3s ease;
        }

        .settings-button i {
            font-size: 28px; /* Adjust the gear icon size */
        }

        /* Hover Effect */
        .settings-button:hover {
            transform: scale(1.1); /* Slightly enlarge on hover */
            background-color: #e0e0e0; /* Change background color on hover */
        }

        /* Focus Effect */
        .settings-button:focus {
            outline: none;
            box-shadow: 0 0 0 3px #007bff; /* Add focus ring */
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<body>

<!-- Settings Button -->
<button id="settingsIcon" class="btn btn-light settings-button" onclick="openSettingsModal()" aria-label="Settings">
    <i class="bi bi-gear"></i>
</button>

<!-- Settings Modal -->
<div class="settings-modal-overlay" id="settingsModal" style="display: none;">
    <div class="settings-modal">
        <h2>Settings</h2>
        <button id="resumeButton" onclick="resumeGame()">Resume</button>
        <button id="quitGameButton" onclick="quitGame()">Quit Game</button>
        <span class="close" onclick="closeSettingsModal()">✖️</span>
    </div>
</div>

<div id="introModal">
    <div class="modal-content">
      <h2>Welcome to Image Recognition: Thresholding and Filtering Game!</h2>
      <p>Welcome, players! Today, we're diving into the world of <strong>thresholding and filtering</strong> in image recognition, essential techniques used in computer vision to process and analyze images.</p>
      <p>In image recognition, one of the key steps is to process the image to highlight important features while minimizing irrelevant details. <strong>Thresholding</strong> is used to convert a grayscale image into a binary image, where specific pixel values are either turned on or off based on a set threshold.</p>
      <p><strong>Filtering</strong>, on the other hand, involves applying specific filters to an image to enhance or suppress certain features, such as edges, textures, or patterns. Filters can help sharpen or smooth an image, making it easier to detect key elements for recognition.</p>
      <p>In this game, you’ll work with thresholding and filtering techniques to process images and identify key features. Your task will be to apply different thresholding methods and filters to prepare images for analysis and recognition.</p>
      <p>By the end of this game, you'll have a better understanding of how thresholding and filtering are applied in image recognition to extract meaningful information from images, which are fundamental techniques in computer vision!</p>
      <button onclick="startGame()">Start Game</button>
    </div>
</div>

<div class="container">
 <div id="gameContainer">
      <div id="stats">
        <div>Player HP: <span id="playerHp">100</span></div>
        <div>Monster HP: <span id="monsterHp">100</span></div>
        <div>Time :<span id="timeElapsed"> 0</span> seconds</div>
        <div id="scoreDisplay">Score: 0</div>
      </div>

      <canvas id="gameScene" width="800" height="300"></canvas>
    <h1>Filterting and Thresholding</h1>
    <p>Use the softmax formula to calculate the confidence score for each target image.</p>

    <!-- Display the Softmax Formula -->
    <div class="formula">
        <p><strong>Softmax Formula:</strong></p>
        <p>
            <code>
                Confidence Score = <sup>e<sup>𝑧<sub>i</sub></sup></sup> / ∑<sub>j</sub> e<sup>𝑧<sub>j</sub></sup>
            </code>
        </p>
        <p>Where:</p>
        <ul>
            <li><strong>𝑧<sub>i</sub></strong>: Logit (raw score) for the predicted class.</li>
            <li><strong>∑<sub>j</sub> e<sup>𝑧<sub>j</sub></sup></strong>: Sum of exponentials of all logits for all classes.</li>
        </ul>
    </div>

    <div class="imagecontainer">
        <h3>Target Image:</h3>
        <!-- Placeholder for the target image -->
        <img src="images/cat.jpg" alt="Target Image" id="target-image">
        
        <h3>Logits for this Image:</h3>
        <div id="logits-container"></div>

        <div id="inputs-container"></div>

        <button onclick="checkAnswers()">Submit</button>
        <div class="feedback" id="feedback"></div>
    </div>
</div>

    <script>

        let gameState = {
            playerHp: 100,
            monsterHp: 100,
            isAttacking: false,
            attackFrame: 0,
            shuffling: false,
            canClick: false,
            playerX: 100,
            playerY: 150,
            monsterX: 550,
            monsterY: 185,
            playerHurt: false,
            monsterHurt: false

        };
        let timeElapsed = 0;
        const timeSpan = document.getElementById("timeElapsed");

        function startGame() {
      document.getElementById('introModal').style.display = 'none'; // Hide intro modal
      loadTask(); // Start the first task
    }

        // Function to update the timer
        function startTimer() {
            setInterval(function() {
                timeElapsed++;
                timeSpan.textContent = timeElapsed;
            }, 1000); // Update every second (1000 milliseconds)
        }

        // Start the timer
        startTimer();

        const gameScene = document.getElementById('gameScene');
        const ctx = gameScene.getContext('2d');
        // List of available categories
        const categories = ["Cat", "Dog", "Bird", "Elephant", "Lion", "Tiger", "Horse", "Rabbit", "Fish"];

        // Function to generate random logits
        function generateRandomLogits() {
            const min = -2; // Minimum logit value
            const max = 3;  // Maximum logit value
            return Math.random() * (max - min) + min;
        }

        // Function to select 3 random categories and generate logits
        function getRandomCategoriesAndLogits() {
            const selectedCategories = [];
            const selectedLogits = {};

            while (selectedCategories.length < 3) {
                const randomIndex = Math.floor(Math.random() * categories.length);
                const category = categories[randomIndex];
                if (!selectedCategories.includes(category)) {
                    selectedCategories.push(category);
                    selectedLogits[category] = generateRandomLogits();
                }
            }

            return { selectedCategories, selectedLogits };
        }

        // Get random categories and logits
        const { selectedCategories, selectedLogits } = getRandomCategoriesAndLogits();

        // Display the selected categories and logits
        const logitsContainer = document.getElementById("logits-container");
        selectedCategories.forEach(category => {
            const logitText = document.createElement("p");
            logitText.innerHTML = `<strong>${category}:</strong> Logit = <span id="${category}-logit">${selectedLogits[category].toFixed(2)}</span>`;
            logitsContainer.appendChild(logitText);
        });

        // Create input fields dynamically for each category
        const inputsContainer = document.getElementById("inputs-container");
        selectedCategories.forEach(category => {
            const inputLabel = document.createElement("label");
            inputLabel.setAttribute("for", `${category}-score`);
            inputLabel.innerHTML = `Confidence Score for ${category}:`;
            inputsContainer.appendChild(inputLabel);
            const input = document.createElement("input");
            input.type = "number";
            input.id = `${category}-score`;
            input.placeholder = `Enter score for ${category}`;
            inputsContainer.appendChild(input);
            inputsContainer.appendChild(document.createElement("br"));
        });

        // Softmax formula implementation
        function softmax(logits) {
            const expLogits = Object.values(logits).map(logit => Math.exp(logit));
            const sumExp = expLogits.reduce((acc, val) => acc + val, 0);
            const scores = expLogits.map(expLogit => expLogit / sumExp);
            return scores;
        }

        // Check if player's answers are correct
        function checkAnswers() {
            const playerScores = {};
            selectedCategories.forEach(category => {
                const score = parseFloat(document.getElementById(`${category}-score`).value);
                playerScores[category] = score;
            });

            // Calculate the correct confidence scores using softmax
            const correctScores = softmax(selectedLogits);

            // Allow some tolerance for floating point comparison
            const tolerance = 0.05;

            // Check if answers are within tolerance
            let correct = true;
            selectedCategories.forEach((category, index) => {
                if (Math.abs(playerScores[category] - correctScores[index]) >= tolerance) {
                    correct = false;
                }
            });

            // Display feedback
            if (correct) {
                document.getElementById("feedback").innerText = "Correct! Well done.";
            } else {
                const correctScoresText = selectedCategories.map((category, index) => {
                    return `${category}: ${correctScores[index].toFixed(3)}`;
                }).join(", ");
                document.getElementById("feedback").innerText = `Incorrect. Correct Scores: ${correctScoresText}`;
            }
        }
        function updateStats() {
            document.getElementById('level').textContent = gameState.level;
            document.getElementById('playerHp').textContent = gameState.playerHp;
            document.getElementById('monsterHp').textContent = gameState.monsterHp;
        }

        const playerImage = new Image();
        playerImage.src = 'images/characters/player.png'; // Replace with the correct path

        const monsterImages = [
            'images/characters/medium/monster1.png', // Replace with correct paths
            'images/characters/medium/monster2.png',
            'images/characters/medium/monster3.png',
            'images/characters/medium/monster4.png', // Replace with correct paths
            'images/characters/medium/monster5.png',
        ];

        const backgroundImage = new Image();
        backgroundImage.src = 'images/background2.png';

        let currentMonsterImage = new Image();
        currentMonsterImage.src = monsterImages[Math.floor(Math.random() * monsterImages.length)];

        class RainParticle {
    constructor(x, y) {
        this.x = x; // Initial x position
        this.y = y; // Initial y position
        this.size = Math.random() * 1 + 1; // Smaller size for rain drops (1 to 2)
        this.length = Math.random() * 10 + 10; // Length of rain drop (10 to 20)
        this.speed = Math.random() * 5 + 4; // Speed of rain (4 to 9)
    }

    update() {
        this.y += this.speed; // Move particle downwards
        // Reset particle position to the top when it moves off screen
        if (this.y > gameScene.height) {
            this.y = 0; // Reappear from the top
            this.x = Math.random() * gameScene.width; // Random horizontal position
        }
    }

    draw(ctx) {
        ctx.strokeStyle = 'rgba(173, 216, 230, 0.6)'; // Light blue color with some transparency
        ctx.lineWidth = 1; // Thin rain drop line
        ctx.beginPath();
        ctx.moveTo(this.x, this.y);
        ctx.lineTo(this.x, this.y - this.length); // Draw a line to represent the rain drop
        ctx.stroke();
    }
}

// Array to hold rain particles
let rainParticles = [];

// Function to initialize rain particles
function initRain() {
    for (let i = 0; i < 100; i++) { // Create 100 rain particles initially
        let x = Math.random() * gameScene.width; // Random initial x position
        let y = Math.random() * gameScene.height; // Random initial y position
        rainParticles.push(new RainParticle(x, y));
    }
}

// Update and draw rain particles
function drawRain(ctx) {
    rainParticles.forEach(particle => {
        particle.update(); // Update position
        particle.draw(ctx); // Draw particle
    });
}
function draw() {
    // Clear the game scene
    ctx.clearRect(0, 0, gameScene.width, gameScene.height);

    // Swaying effect for the background
    const swayOffset = 5 * Math.sin(Date.now() / 1000); // Adjust sway speed and distance
    ctx.drawImage(backgroundImage, swayOffset, 0, gameScene.width, gameScene.height);

    // Draw sand particles in the background
    drawRain(ctx);

    // Calculate breathing effect for the player and monster
    const breathingScale = 1 + 0.02 * Math.sin(Date.now() / 300); // Adjust scale and speed as needed

    // Shadow for player
    ctx.fillStyle = 'rgba(0, 0, 0, 0.3)'; // Dark gray with transparency
    ctx.beginPath();
    ctx.ellipse(gameState.playerX + 60, gameState.playerY + 113, 30, 3, 0, 0, 2 * Math.PI); // Simple ellipse shadow
    ctx.fill();

    // Draw player with breathing effect
    const playerWidth = 120 * breathingScale;
    const playerHeight = 120 * breathingScale;
    ctx.drawImage(
        playerImage,
        gameState.playerX - (playerWidth - 120) / 2, // Center breathing effect
        gameState.playerY - (playerHeight - 120) / 2,
        playerWidth,
        playerHeight
    );

    // Shadow for monster
    ctx.fillStyle = 'rgba(0, 0, 0, 0.3)'; // Dark gray with transparency
    ctx.beginPath();
    ctx.ellipse(gameState.monsterX + 80, gameState.monsterY + 160, 20, 7, 0, 0, 2 * Math.PI); // Smaller ellipse shadow
    ctx.fill();

    // Draw monster with breathing effect
    const monsterWidth = 150 * breathingScale;
    const monsterHeight = 150 * breathingScale;
    ctx.drawImage(
        currentMonsterImage,
        gameState.monsterX - (monsterWidth - 150) / 2,
        gameState.monsterY - (monsterHeight - 150) / 2,
        monsterWidth,
        monsterHeight
    );

    // If the player is hurt, overlay a red tint
    if (gameState.playerHurt) {
        ctx.fillStyle = 'rgba(255, 153, 153, 0.5)';
        ctx.fillRect(gameState.playerX, gameState.playerY, 120, 120);
    }

    // If the monster is hurt, overlay a red tint
    if (gameState.monsterHurt) {
        ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
        ctx.fillRect(gameState.monsterX, gameState.monsterY, 150, 150);
    }

    // Check for player or monster attack
    if (gameState.isPlayerAttacking || gameState.isMonsterAttacking) {
        // Play sound effects when attacking
        if (gameState.isPlayerAttacking) {
            let playerAttackSound = document.getElementById("playerAttackSound");
            if (playerAttackSound.paused) {
                playerAttackSound.play();
            }
        }

        if (gameState.isMonsterAttacking) {
            let monsterAttackSound = document.getElementById("monsterAttackSound");
            if (monsterAttackSound.paused) {
                monsterAttackSound.play();
            }
        }

        // Draw attack line
        ctx.beginPath();
        ctx.moveTo(gameState.playerX + 60, gameState.playerY + 40);
        ctx.lineTo(gameState.monsterX, gameState.monsterY + 50);

        // Draw blood splash
        if (gameState.bloodSplash) {
            const numberOfDroplets = 10;
            for (let i = 0; i < numberOfDroplets; i++) {
                const dropletX = gameState.bloodSplash.x + (Math.random() - 0.5) * 60;
                const dropletY = gameState.bloodSplash.y + (Math.random() - 0.5) * 60;
                const dropletRadius = Math.random() * 10 + 5;

                const gradient = ctx.createRadialGradient(dropletX, dropletY, dropletRadius / 4, dropletX, dropletY, dropletRadius);
                gradient.addColorStop(0, 'rgba(255, 0, 0, 0.9)');
                gradient.addColorStop(1, 'rgba(139, 0, 0, 0.6)');

                ctx.globalAlpha = gameState.bloodSplash.opacity;
                ctx.fillStyle = gradient;
                ctx.beginPath();
                ctx.arc(dropletX, dropletY, dropletRadius, 0, 2 * Math.PI);
                ctx.fill();
            }
            ctx.globalAlpha = 1;
        }

        // Draw damage text
        if (gameState.damageText) {
            ctx.globalAlpha = gameState.damageText.opacity;
            ctx.fillStyle = '#FF0000';
            ctx.font = 'bold 24px Arial';
            ctx.fillText(25, gameState.damageText.x, gameState.damageText.y);
            ctx.globalAlpha = 1;
        }
    }

    requestAnimationFrame(draw);
}

// Initialize particles on game start
initRain();

        function animateAttack(attacker, damage) {
    const attackDuration = 30; // Number of frames for the attack animation
    const moveDistance = 400; // Distance to move
    const frameRate = 60; // Assuming 60 FPS
    const bloodSplashDuration = 10; // Frames for blood splash
    const damageTextDuration = 60; // Frames for damage text to fade out

    // Variables to track blood splash and damage text animation
    let bloodSplashOpacity = 1;
    let damageTextOpacity = 1;
    let damageTextY = 0;

    function animate() {
        gameState.attackFrame++;

    if (gameState.attackFrame <= attackDuration / 2) {
        // Move towards the target
        if (attacker === 'player') {
            gameState.playerX += moveDistance / (attackDuration / 2);
        } else {
            gameState.monsterX -= moveDistance / (attackDuration / 2);
        }
    } else if (gameState.attackFrame === Math.floor(attackDuration / 2) + 1) {
        // Hit the target and trigger blood splash and damage text
        if (attacker === 'player') {
            gameState.monsterHurt = true;
            gameState.bloodSplash = {
                x: gameState.monsterX + 50, // Adjust this position to ensure it aligns with the monster's body
                y: gameState.monsterY + 30, // Adjust Y as needed
                opacity: 1
            };
            gameState.damageText = {
                text: `-${damage}`,
                x: gameState.monsterX + 50, // Ensure the text is positioned centrally
                y: gameState.monsterY - 50,
                opacity: 1
            };
        } else {
            gameState.playerHurt = true;
            gameState.bloodSplash = {
                x: gameState.playerX + 50, // Adjust this position to align with the player's body
                y: gameState.playerY + 30,
                opacity: 1
            };
            gameState.damageText = {
                text: `-${damage}`,
                x: gameState.playerX + 50,
                y: gameState.playerY - 50,
                opacity: 1
            };
        }
        updateStats();
    } else if (gameState.attackFrame <= attackDuration) {
        // Move back to original position
        if (attacker === 'player') {
            gameState.playerX -= moveDistance / (attackDuration / 2);
        } else {
            gameState.monsterX += moveDistance / (attackDuration / 2);
        }
    }

    // Animate blood splash (fade out)
    if (gameState.attackFrame > Math.floor(attackDuration / 2)) {
        if (gameState.bloodSplash) {
            gameState.bloodSplash.opacity -= 1 / bloodSplashDuration;
            if (gameState.bloodSplash.opacity <= 0) {
                gameState.bloodSplash = null; // Remove blood splash
            }
        }

        // Animate floating damage text (move up and fade out)
        if (gameState.damageText) {
            gameState.damageText.opacity -= 1 / damageTextDuration;
            gameState.damageText.y -= 2; // Move damage text upwards
            if (gameState.damageText.opacity <= 0) {
                gameState.damageText = null; // Remove damage text
            }
        }
    }

    // End of animation
    if (gameState.attackFrame >= attackDuration) {
        if (attacker === 'player') {
            gameState.isPlayerAttacking = false;
            gameState.monsterHurt = false;
            gameState.playerX = 100; // Reset to initial position
        } else {
            gameState.isMonsterAttacking = false;
            gameState.playerHurt = false;
            gameState.monsterX = 600; // Reset to initial position
        }
        return;
    }

    // Continue the animation
    requestAnimationFrame(animate);
}

// Call the animation to start it
animate();
}

        function monsterAttack() {
            if (!gameState.isPlayerAttacking && !gameState.isMonsterAttacking) {
                gameState.isMonsterAttacking = true;
                gameState.attackFrame = 0;
                animateAttack('monster');
            }
        }
        
// Settings Functionality
function openSettingsModal() {
    const settingsModal = document.getElementById('settingsModal');
    settingsModal.style.display = 'flex'; // Show the settings modal

    if (typeof quizOn !== 'undefined' && quizOn === false) {
        pauseTimer(); // Pause the timer if the quiz is ongoing
    }
}

function closeSettingsModal() {
    const settingsModal = document.getElementById('settingsModal');
    settingsModal.style.display = 'none'; // Hide the settings modal
}

function resumeGame() {
    closeSettingsModal(); // Close the settings modal

    if (typeof quizOn !== 'undefined' && quizOn === false) {
        resumeTimer(); // Resume the timer if paused
    }
}

function quitGame() {
    window.location.href = "{{ url('play') }}"; // Redirect to the main menu
}
        // Start the game
        draw();
    </script>
</body>
</html>
