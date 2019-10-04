    function unchkfunc() {
        if(document.getElementById("chkbox").checked != true){
            var box = confirm("ยืนยันการเปลี่ยนแปลง?");
            if(box == true){
                return false;
            }else{
                return document.getElementById("chkbox").checked = true;
            }
        }else{
            var box = confirm("ยืนยันการเปลี่ยนแปลง?");
            if(box != true){
                return document.getElementById("chkbox").checked = false;
            }else{
                return true;
            }
        }
    }

    function chkfunc() {
        if(document.getElementById("chkedbox").checked == true){
            var box = confirm("ยืนยันการเปลี่ยนแปลง?");
            if(box == true){
                return true;
            }else{
                return document.getElementById("chkedbox").checked = false;
            }
        }else{
            var box = confirm("ยืนยันการเปลี่ยนแปลง?");
            if(box != true){
                return document.getElementById("chkedbox").checked = true;
            }else{
                return false;
            }
        }
    }