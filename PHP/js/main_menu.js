/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$("body").on("click", ".MainMenuElement", function() 
{
   $('.MainMenu .MainMenuElement').removeClass('ElementBlock');
   $(this).addClass('ElementBlock'); 
});