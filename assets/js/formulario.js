
    function actualizarProf(espec){
        var dia = -1;
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
                dia = 1;
                break;
            default:
                document.getElementById("profesional").innerHTML = '<option value="">- Profesional -</option> <option value="ramallo">Dr. Ramallo Julián</option> <option value="lamas">Dra. Lamas Cecilia</option> <option value="dejuana">Dr. De Juana Gastón P.</option> <option value="cardozo">Dra. Cardozo Gutiérrez Romina</option> <option value="parisi">Dr. Parisi Ricardo</option> <option value="espil">Lic. Espil Clara</option> <option value="peralta">Lic. Peralta Francisca</option> <option value="reusmann">Dra. Reusmann Aixa</option>';
                document.getElementById("profesional").value="";
        }
        if (dia == -1) {
            document.getElementById("fecha").disabled = true;    
        } else {
            document.getElementById("fecha").disabled = false;                    
        }
        
    }