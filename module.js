M.tabtopic={
      
    init : function(Y){
        
        
       
            
        Y.use('tabview', function(Y){
          
            var tabview = new Y.TabView({       
                srcNode: '#sections'
            });
            
            tabview.render();
            
        });
        
        addonload(function(){document.getElementById("maincontainer").style.display='';}); 
               
    }


}
