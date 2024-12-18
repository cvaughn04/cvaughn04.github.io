/*    JavaScript 7th Edition
      Chapter 2
      Project 02-03

      Application to return the shape of a clicked object
      Author: 
      Date:   

      Filename: project02-03.js
 */

      const feedBack = document.getElementById('feedback');

      const triangle = document.getElementById('triangle');
      triangle.onmouseover = () =>{
            feedBack.innerHTML = "You're hovering over the triangle";
      };
      triangle.onmouseout = () =>{
            feedBack.innerHTML = "";
      };
      
      const circle = document.getElementById('circle');
      circle.onmouseover = () =>{
            feedBack.innerHTML = "You're hovering over the circle";
      };
      circle.onmouseout = () =>{
            feedBack.innerHTML = "";
      };
      
      const square = document.getElementById('square');
      square.onmouseover = () =>{
            feedBack.innerHTML = "You're hovering over the square";
      };
      square.onmouseout = () =>{
            feedBack.innerHTML = "";
      };