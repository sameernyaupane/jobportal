$("#search-term").bind("keypress", {}, keypressInBox);

function keypressInBox(e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {                    
        e.preventDefault();

        $('#search').submit();
    }
};
