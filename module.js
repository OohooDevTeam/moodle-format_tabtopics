M.tabtopic={

    init : function(Y){




        $("#maincontainer").tabs();

        $(document).ready(function() {
            //Put a border around each container
            $("#maincontainer").children("div").css("border", "1px solid black");
            //Add a bar under the tabs which has the same color as the selected tab
            $("<div></div>").css({
                height: '5px',
                width: '100%',
                'background-color': $("#maincontainer .ui-tabs-nav .ui-tabs-selected").css('background-color')
            }).insertAfter("#maincontainer .ui-tabs-nav");
            $("#maincontainer").show();
        });

    }


}
