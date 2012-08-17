/* * **********************************************************************
 * *                     TabTopics Course Format                         **
 * ************************************************************************
 * @package     format                                                   **
 * @subpackage  tabtopics                                                **
 * @name        TabTopics                                                **
 * @copyright   oohoo.biz                                                **
 * @link        http://oohoo.biz                                         **
 * @author      Braedan Jongerius <jongeriu@ualberta.ca>                 **
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later **
 * ************************************************************************
 * ********************************************************************** */

$(function() {
    //Activate the tab display
    $(".topics").tabs();
    //Put a border around each container
    $(".topics").children("div").css("border", "1px solid black");
    //Add a bar under the tabs which has the same color as the selected tab
    $("<div></div>").css({
        height: '5px',
        width: '100%',
        'background-color': $(".topics .ui-tabs-nav .ui-tabs-selected").css('background-color')
    }).insertAfter(".topics .ui-tabs-nav");
    //Select the tab for the highlighted topic when a specfic tab isn't specified in url
    if (window.location.href.indexOf("#") == -1) {
        $(".topics").tabs("select", $(".topics .current").attr('id'));
    }
    //Display the tabs since they were hidden by default
    $(".topics").show();
});
