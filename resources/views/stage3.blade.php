<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RGB Color Space Analysis</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background-color: #f0f8ff;
      margin: 20px;
    }

    .pixel-data {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 20px;
    }
    .pixel {
      text-align: center;
    }
    .color-box {
      width: 50px;
      height: 50px;
      border: 1px solid #000;
      margin-bottom: 5px;
    }
    .input-row {
      margin: 10px 0;
    }
    input {
      width: 80px;
      padding: 5px;
      font-size: 14px;
      margin: 5px;
    }
    button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
    .feedback {
      margin-top: 20px;
      font-size: 18px;
    }
    .formula {
      font-size: 16px;
      font-style: italic;
      margin-bottom: 15px;
    }
    #scoreDisplay {
      font-size: 18px;
      margin-top: 20px;
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

        .victory {
            transform: scale(1.2) translateY(-30px);
            box-shadow: 0 0 30px #FFD700;
            z-index: 100;
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


  
        .btn-submit {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            border-radius: 25px;
            transition: background-color 0.3s, box-shadow 0.3s;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background-color: #45a049;
            box-shadow: 0 0 10px rgba(0, 255, 127, 0.7);
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
     <!-- Intro Modal -->
  <div id="introModal">
    <div class="modal-content">
      <h2>Welcome to RGB Color Analysis Game!</h2>
      <p>Welcome, players! Today, we're diving into the fascinating world of colors and how computers understand them. Colors in digital images are represented using the <strong>RGB color model</strong>—a system that combines three primary colors: <strong>Red</strong>, <strong>Green</strong>, and <strong>Blue</strong>. These three colors are the building blocks of all the images you see on your screen.</p>
      <p>Now, why RGB? Well, the human eye is sensitive to red, green, and blue light. By combining different amounts of these colors, we can create any color we want. Think of it like mixing paint: by adjusting the amount of red, green, and blue, you can paint virtually any color!</p>
      <p>Each of the three colors—Red (R), Green (G), and Blue (B)—can have a value between <strong>0</strong> and <strong>255</strong>. A value of <strong>0</strong> means that color is not present at all, while <strong>255</strong> means it's fully present. For example, if we have a color with values of (255, 0, 0), we get <strong>pure red</strong>. If the values are (0, 255, 0), we get <strong>pure green</strong>, and (0, 0, 255) gives us <strong>pure blue</strong>. When all three colors are at their maximum, (255, 255, 255), we get <strong>white</strong>, and when all three are at zero, (0, 0, 0), we get <strong>black</strong>.</p>
      <p>In this game, you’ll analyze pixel colors and calculate the average RGB values of multiple pixels. Each pixel will have its own mix of red, green, and blue, and your task is to figure out the overall average color.</p>
      <p>So, let's start exploring the colors around you and see how well you can identify their exact makeup!</p>
      <button onclick="startGame()">Start Game</button>
    </div>
  </div>

  <div class="container">
    <div id="gameContainer">
      <div id="stats">
        <div>Player HP: <span id="playerHp">100</span></div>
        <div>Monster HP: <span id="monsterHp">100</span></div>
        <div id="scoreDisplay">Score: 0</div>
        <div>Time :<span id="timeElapsed"> 0</span> seconds</div>
      </div>
      <canvas id="gameScene" width="800" height="300"></canvas>
      <h1>RGB Color Analysis</h1>
      <p>Analyze the pixel colors and solve the task below:</p>
      <div class="pixel-data" id="pixelData"></div>
      <p id="taskText"></p>
      <p class="formula" id="formula"></p>
      <div class="input-row">
        <label for="rInput">R:</label>
        <input type="number" id="rInput" min="0" max="255" placeholder="0">
        <label for="gInput">G:</label>
        <input type="number" id="gInput" min="0" max="255" placeholder="0">
        <label for="bInput">B:</label>
        <input type="number" id="bInput" min="0" max="255" placeholder="0">
      </div>
      <button onclick="checkAnswer()">Submit Answer</button>
      <div class="feedback" id="feedback"></div>
    </div>
    
  </div>
  <script>
    let gameState = {
            playerHp: 100,
            monsterHp: 100,
            isAttacking: false,
            attackFrame: 0,
            playerX: 100,
            playerY: 150,
            monsterX: 550,
            monsterY: 185,
            playerHurt: false,
            monsterHurt: false

        };
        const gameScene = document.getElementById('gameScene');
        const ctx = gameScene.getContext('2d');
    // DOM Elements
    const pixelDataElement = document.getElementById('pixelData');
    const taskText = document.getElementById('taskText');
    const formulaText = document.getElementById('formula');
    const feedback = document.getElementById('feedback');
    const rInput = document.getElementById('rInput');
    const gInput = document.getElementById('gInput');
    const bInput = document.getElementById('bInput');
    const scoreDisplay = document.getElementById('scoreDisplay');
    const timeElapsedDisplay = document.getElementById('timeElapsed');

    let pixelData;
    let correctAnswer;
    let startTime;
    let score = 0;
    let timerInterval;

      // Function to start the game
      function startGame() {
      document.getElementById('introModal').style.display = 'none'; // Hide intro modal
      loadTask(); // Start the first task
    }

    // Generate random pixel data
    function generatePixelData(numPixels) {
      const pixels = [];
      for (let i = 0; i < numPixels; i++) {
        pixels.push({
          r: Math.floor(Math.random() * 256),
          g: Math.floor(Math.random() * 256),
          b: Math.floor(Math.random() * 256),
        });
      }
      return pixels;
    }

    // Display pixel data as colors and values
    function displayPixelData() {
      pixelDataElement.innerHTML = '';
      pixelData.forEach((pixel, index) => {
        const pixelDiv = document.createElement('div');
        pixelDiv.className = 'pixel';

        const colorBox = document.createElement('div');
        colorBox.className = 'color-box';
        colorBox.style.backgroundColor = `rgb(${pixel.r}, ${pixel.g}, ${pixel.b})`;

        const pixelInfo = document.createElement('p');
        pixelInfo.textContent = `(${pixel.r}, ${pixel.g}, ${pixel.b})`;

        pixelDiv.appendChild(colorBox);
        pixelDiv.appendChild(pixelInfo);
        pixelDataElement.appendChild(pixelDiv);
      });
    }

    // Calculate average RGB values
    function calculateAverageRGB() {
      let totalR = 0, totalG = 0, totalB = 0;

      pixelData.forEach(pixel => {
        totalR += pixel.r;
        totalG += pixel.g;
        totalB += pixel.b;
      });

      return {
        r: Math.round(totalR / pixelData.length),
        g: Math.round(totalG / pixelData.length),
        b: Math.round(totalB / pixelData.length),
      };
    }

    // Update formula display
    function updateFormula() {
      const formula = `
        Average R = ΣR / N, Average G = ΣG / N, Average B = ΣB / N
        where N = ${pixelData.length}
      `;
      formulaText.textContent = formula;
    }

    // Load a new task
    function loadTask() {
      feedback.textContent = '';
      rInput.value = '';
      gInput.value = '';
      bInput.value = '';

      // Generate new pixel data
      pixelData = generatePixelData(5);

      // Display pixel data
      displayPixelData();

      // Set the task and calculate the answer
      taskText.textContent = 'Task: Calculate the average RGB color.';
      correctAnswer = calculateAverageRGB();

      // Update formula display
      updateFormula();

      // Start timer
      startTime = Date.now();
      timerInterval = setInterval(updateTimer, 1000); // Update every second
    }

    // Update the running timer display
    function updateTimer() {
      const timeElapsed = ((Date.now() - startTime) / 1000).toFixed(1); // in seconds
      timeElapsedDisplay.textContent = timeElapsed;
    }

    // Check user's answer
    function checkAnswer() {
      const userAnswer = {
        r: parseInt(rInput.value),
        g: parseInt(gInput.value),
        b: parseInt(bInput.value),
      };

      const tolerance = 5; // Allow small deviation
      const isCorrect =
        Math.abs(userAnswer.r - correctAnswer.r) <= tolerance &&
        Math.abs(userAnswer.g - correctAnswer.g) <= tolerance &&
        Math.abs(userAnswer.b - correctAnswer.b) <= tolerance;

      // Stop the timer
      clearInterval(timerInterval);

      // Calculate time taken
      const timeTaken = ((Date.now() - startTime) / 1000).toFixed(1); // in seconds

      if (isCorrect) {
        feedback.textContent = `Correct! Well done. Time taken: ${timeTaken} seconds.`;
        feedback.style.color = 'green';
        score += 10; // Increase score for correct answer
        scoreDisplay.textContent = `Score: ${score}`;
        setTimeout(loadTask, 2000); // Load next task
      } else {
        feedback.textContent = `Incorrect. Correct Answer: R=${correctAnswer.r}, G=${correctAnswer.g}, B=${correctAnswer.b}. Time taken: ${timeTaken} seconds.`;
        feedback.style.color = 'red';
        setTimeout(loadTask, 2000); // Load next task
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
            'images/characters/easy/monster1.png', // Replace with correct paths
            'images/characters/easy/monster2.png',
            'images/characters/easy/monster3.png'
        ];

        const backgroundImage = new Image();
        backgroundImage.src = 'images/background.jpg';

        let currentMonsterImage = new Image();
        currentMonsterImage.src = monsterImages[Math.floor(Math.random() * monsterImages.length)];

        // Particle class to handle individual sand particles
// Particle class to handle individual sand particles
class Particle {
    constructor(x, y) {
        this.x = x; // Initial x position
        this.y = y; // Initial y position
        this.size = Math.random() * 3 + 1; // Random small size for the particle (1 to 4)
        this.speed = Math.random() * 4 + 2; // Increased speed of the particle (now 2 to 6)
    }

    update() {
        this.x -= this.speed; // Move particle to the left
        // Reset particle position to the right when it moves off screen
        if (this.x < 0) {
            this.x = gameScene.width; // Reappear from the right
            this.y = Math.random() * gameScene.height; // Random vertical position
        }
    }

    draw(ctx) {
        ctx.fillStyle = 'rgba(222, 184, 135, 0.8)'; // Light sand color with some transparency
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
    }
}

// Array to hold particles
let particles = [];

// Function to initialize particles
function initParticles() {
    for (let i = 0; i < 100; i++) { // Create 100 particles initially
        let x = Math.random() * gameScene.width; // Random initial x position
        let y = Math.random() * gameScene.height; // Random initial y position
        particles.push(new Particle(x, y));
    }
}

// Update and draw sand particles
function drawParticles(ctx) {
    particles.forEach(particle => {
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
    drawParticles(ctx);

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
    ctx.ellipse(gameState.monsterX + 35, gameState.monsterY + 70, 20, 7, 0, 0, 2 * Math.PI); // Smaller ellipse shadow
    ctx.fill();

    // Draw monster with breathing effect
    const monsterWidth = 70 * breathingScale;
    const monsterHeight = 70 * breathingScale;
    ctx.drawImage(
        currentMonsterImage,
        gameState.monsterX - (monsterWidth - 70) / 2,
        gameState.monsterY - (monsterHeight - 70) / 2,
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
        ctx.fillRect(gameState.monsterX, gameState.monsterY, 70, 70);
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
            ctx.fillText(damage, gameState.damageText.x, gameState.damageText.y);
            ctx.globalAlpha = 1;
        }
    }

    requestAnimationFrame(draw);
}

// Initialize particles on game start
initParticles();



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


        // Call this function to trigger the attack
        function triggerAttack() {
            gameState.isAttacking = true;
        }

        function attackMonster(damage) {
            gameState.isAttacking = true;
            gameState.attackFrame = 0;
            gameState.monsterHp = Math.max(0, gameState.monsterHp - damage);

            if (!gameState.isPlayerAttacking && !gameState.isMonsterAttacking) {
                gameState.isPlayerAttacking = true;
                gameState.attackFrame = 0;
                animateAttack('player');
            }
            updateStats();
        }

        function takeDamage() {
            gameState.playerHp = Math.max(0, gameState.playerHp - 10);
            updateStats();
            if (gameState.playerHp <= 0) {
                setTimeout(() => {
                    showGameOverModal();
                    resetGame();
                }, 500);
            }
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

draw();
    // Initialize game
    loadTask();
  </script>
</body>
</html>
