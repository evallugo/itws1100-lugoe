# Lab 6 - JavaScript and jQuery

## In this lab, we are going to work with jQuery and continue work on our personal websites

### Lab guidance (setup)

- - -

1. Download and extract the zip file from LMS into a folder on your local machines 
a. *outside* of your repository into a temporary folder.
2. Checkout a development branch on your class website's production repository
a. name it anything you want, e.g. lab06
3. Copy the lab 6 files from your temporary folder to the appropriate place in your development branch

- - -  

### Lab specifics (jQuery)

1. There are 5 files included in the assignment repository

> lab6.css,  
lab6.html,  
lab6.js,  
a minimized jQuery file, and this  
readme.md file

2. Follow the instructions in the JavaScript file for this lab  
3. When you have finished completing the instructions for lab 6 that are in the lab6.js file, and your lab6.html works as expected...  

 // Problem 5 (10 pts) - what happens when you click on the new li?  Why? (Explain in your readme file)
  //   ie if it works as after #3 above, why? if it doesn't, why not?  How would you fix it?
  //   If it doesm't work - fix it.
  //   (Note that you need to look up the appropriate jQuery method - discussed in class - to do this)
  Nothing would happen if you click the lists. The new list items wouldn't turn red because they were created after the initial event handlers were bound. Direct event binding only affects elements that exist at the time the code runs. Dynamic elements created later don't automatically get these event handlers. To fix this I used event delegation with .on() where you attach the event to a parent element that's always in the DOM, and specify a selector for child elements that should trigger the event.

links to repo and iit website:
iit website: http://lugoerpi.eastus.cloudapp.azure.com/iit/
lab 6 link: http://lugoerpi.eastus.cloudapp.azure.com/iit/labs/6/
repo link: https://github.com/evallugo/itws1100-lugoe.git
- - -

### Lab 6 guidance (Completion and Submission)

1. Create a landing lage for your lab (it must match the style of your website)
a. make sure to describe the lab and what we did  
b. make sure to link to your solution  
2. Update your projects page to link to your lab landing page
3. don't forget to include a readme  
a. make sure to include links to your homepage, your lab page, and your github repo
4. test your website in your development environment.

- - -

1. Once tested, Stage your code, test again, and Merge it into Production.
2. Deploy to your server.
3. Test again
4. Submit your zip of your repo to LMS - make sure it includes the correct links
