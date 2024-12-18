"use strict";

// Reference to the tangram puzzle board
let puzzleBoard = document.getElementById("puzzle");

// Counter for the zIndex style of each puzzle piece
let zCounter = 1;
let eventX, eventY, tanX, tanY, currentTan;

// Node list representing the tangram pieces
let tans = document.querySelectorAll("div#puzzle > img");

// Function to rotate a tan by a specified number of degrees
function rotateTan(elem, deg) {
   const obj = window.getComputedStyle(elem, null);
   const matrix = obj.getPropertyValue("transform");
   let angle = 0;
   if (matrix !== "none") {
      const values = matrix.split('(')[1].split(')')[0].split(',');
      const a = values[0];
      const b = values[1];
      angle = Math.round(Math.atan2(b, a) * (180 / Math.PI));
   }

   if (angle < 0) {
      angle += 360;
   }

   let newAngle = angle + deg;

   elem.style.transform = "rotate(" + newAngle + "deg)";
}

// Function to handle pointerdown event for tangram pieces
function grabTan(e) {
   if (e.shiftKey) {
      rotateTan(e.target, 15);
   } else {
      eventX = e.clientX;
      eventY = e.clientY;
      tanX = e.target.getBoundingClientRect().left;
      tanY = e.target.getBoundingClientRect().top;
      currentTan = e.target;
      currentTan.style.touchAction = "none";
      zCounter++;
      currentTan.style.zIndex = zCounter;

      document.addEventListener("pointermove", moveTan);
      document.addEventListener("pointerup", dropTan);
   }
}

// Function to handle pointermove event for dragging the tangram pieces
function moveTan(e) {
   const deltaX = e.clientX - eventX;
   const deltaY = e.clientY - eventY;
   currentTan.style.left = tanX + deltaX + "px";
   currentTan.style.top = tanY + deltaY + "px";
}

// Function to handle pointerup event for dropping the tangram pieces
function dropTan() {
   document.removeEventListener("pointermove", moveTan);
   document.removeEventListener("pointerup", dropTan);
   currentTan.style.touchAction = "auto";
}

// Add event listeners for pointerdown on each tangram piece
tans.forEach((tan) => {
   tan.addEventListener("pointerdown", grabTan);
});