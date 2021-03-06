    function actualizarProf(espec){
        switch (espec) {
            case "cirugiaplastica":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option  value="ramallo">Dr. Ramallo Julián</option> <option value="dejuana">Dr. De Juana Gastón P.</option>';
                break;
            case "cirugiageneral":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option  value="ramallo">Dr. Ramallo Julián</option> <option value="dejuana">Dr. De Juana Gastón P.</option> <option value="parisi">Dr. Parisi Ricardo</option>';
                break;
            case "medicinaestetica":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option  value="ramallo">Dr. Ramallo Julián</option> <option value="lamas">Dra. Lamas Cecilia</option>';
                break;
            case "flebotomia":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option  value="ramallo">Dr. Ramallo Julián</option>';
                document.getElementById("profesional").value="ramallo";
                break;
            case "cirugialaparoscopica":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option  value="ramallo">Dr. Ramallo Julián</option>';
                document.getElementById("profesional").value="ramallo";
                break;
            case "dermatologiaclinica":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="lamas">Dra. Lamas Cecilia</option>';
                document.getElementById("profesional").value="lamas";
                break;
            case "dermatologiaestetica":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="lamas">Dra. Lamas Cecilia</option>';
                document.getElementById("profesional").value="lamas";
                break;
            case "ginecologia":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="cardozo">Dra. Cardozo Gutiérrez Romina</option>';
                document.getElementById("profesional").value="cardozo";
                break;
            case "esteticagenitalfemenina":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="cardozo">Dra. Cardozo Gutiérrez Romina</option>';
                document.getElementById("profesional").value="cardozo";
                break;
            case "psicologia":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="espil">Lic. Espil Clara</option>';
                document.getElementById("profesional").value="espil";
                break;
            case "cosmetologia":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="peralta">Lic. Peralta Francisca</option>';
                document.getElementById("profesional").value="peralta";
                break;
            case "cirugiapediatrica":
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="reusmann">Dra. Reusmann Aixa</option>';
                document.getElementById("profesional").value="reusmann";
                break;
            default:
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="ramallo">Dr. Ramallo Julián</option> <option value="lamas">Dra. Lamas Cecilia</option> <option value="dejuana">Dr. De Juana Gastón P.</option> <option value="cardozo">Dra. Cardozo Gutiérrez Romina</option> <option value="parisi">Dr. Parisi Ricardo</option> <option value="espil">Lic. Espil Clara</option> <option value="peralta">Lic. Peralta Francisca</option> <option value="reusmann">Dra. Reusmann Aixa</option>';
                document.getElementById("profesional").value="";
        }
        habilitarDias(document.getElementById("profesional").value);

    }
    function habilitarDias(prof){
    /* <<< doctores disponibles >>>
        ""
        "ramallo"           Jueves 14-20hs; 
        "lamas"             Martes 12-20hs
        "dejuana"           Miércoles 14-16hs
        "cardozo"           Lunes 16-18hs
        "parisi"            Jueves 16-18hs
        "espil"             Lunes 17-20hs
        "peralta"           Sabados 9-13hs
        "reusmann"          Lunes 14-17hs
    */
        // reseteamos los campos necesarios para la nueva seleccion
        document.getElementById("fecha").value = "";
        document.getElementById("txtHint").innerHTML = "<input type='text' placeholder='Horarios disponibles' disabled required />";
        
        
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
        
        var calendario = $('#fecha').glDatePicker(
        {
            cssName: 'flatwhite',
            selectedDate: new Date(yyyy, mm, dd),
            selectableDateRange: [
                { from: new Date(yyyy, mm, dd+1),
                    to: new Date(yyyy, mm+3, dd) }
            ],
        }).glDatePicker(true);

            var dia = -1;
            switch(prof) {
                case "ramallo" : dia = 4; break;
                case "lamas"   : dia = 2; break;
                case "dejuana" : dia = 3; break;
                case "cardozo" : dia = 1; break;
                case "parisi"  : dia = 4; break;
                case "espil"   : dia = 1; break;
                case "peralta" : dia = 6; break;
                case "reusmann": dia = 1; break;
            }
            if (dia == -1) {
                document.getElementById("fecha").disabled = true;    
            } else {
                document.getElementById("fecha").disabled = false;                    
                calendario.options.selectableDOW = [dia];
                calendario.render();
            }
    }

    function verHorarios() {
        var prof = document.getElementById("profesional").value;
        var fec = document.getElementById("fecha").value;
        
        // mostrar icono loading
        document.getElementById("txtHint").innerHTML = "<img src=\"images/loading.gif\" style=\"height: 30px\" />";
//        doc = document.getElementById("doc").value;
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET","./verHorarios.php?fecha="+fec+"&prof="+prof,true);
        xmlhttp.send();    
    }
