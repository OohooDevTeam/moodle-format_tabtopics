M.tabtopic={

    init : function(Y){




        $("#maincontainer").tabs();

        $(document).ready(function() {
            $("#maincontainer").children("div").css("border", "1px solid #243356");
            $("<div></div>").css({
                height: '5px',
                width: '100%',
                'background-color': $("#maincontainer .ui-tabs-nav .ui-tabs-selected").css('background-color')
            }).insertAfter("#maincontainer .ui-tabs-nav");
            $("#maincontainer").show();
        });

    }


}
