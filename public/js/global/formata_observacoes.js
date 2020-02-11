<script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
    
 $('table').find('td.obs').each(function() {
    
    $(this).html($(this).html().substring(0, 40) + '[...]');
    }); 
    
        });


        function checkAll(bx) {
            var cbs = document.getElementsByTagName('input');
            for (var i = 0; i < cbs.length; i++) {
                if (cbs[i].type == 'checkbox') {
                    cbs[i].checked = bx.checked;
                }
            }
        }
    </script>