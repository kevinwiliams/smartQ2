<script>
  

    //print a div
    function printThis(content = "", reload = false) {

        if (content.length < 64 && $('#' + content).length > 0) { 
            // if element length less than 64 characters and is a ID
            content = $('head').html() + $('#' + content).clone().html();
        }  

        try {
            var ua = navigator.userAgent;

            if (/Chrome/i.test(ua)) {
                $('<iframe>', {
                    name: 'myiframe',
                    class: 'printFrame'
                })
                .appendTo('body')
                .contents().find('body')
                .append(content);

                setTimeout(() => { 
                    window.frames['myiframe'].focus();
                    window.frames['myiframe'].print();
                    $('iframe.printFrame').remove();
                }, 200);

            } else if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Mobile|mobile|CriOS/i.test(ua)) {     
            
                var win = window.open('about:blank', 'Token' + (new Date()).getTime());
                win.document.write(content); 

                setTimeout(function () {
                    win.document.close();
                    win.focus();
                    win.print();
                    win.close(); 
                }, 200);   

            } else {

                var originalContent = $('body').html();
                $('body').empty().html(content);
                window.print();
                $('body').html(originalContent);

            }

        } catch(e) {

            var originalContent = $('body').html();
            $('body').empty().html(content);
            window.print();
            $('body').html(originalContent);
        }

        if (reload) {
            history.go(0);
        }
    }
    
    </script>