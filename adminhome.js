function addSubjects(){
    var year = document.getElementById("year").value;
    var semester = document.getElementById("semester").value;
    var branch = document.getElementById("branch").value;
    var numSections = document.getElementById("numSections").value;
    var numSubjects = document.getElementById("numSubjects").value;
    var numLabs = document.getElementById("numLabs").value;
    if (!year || !semester || !branch || !numSections || !numSubjects || !numLabs) {
        return false;
    }
    document.getElementById('addSubjectsBtn').style.display = 'none'
    for(var i=1;i<=numSubjects;i++){
        var tr = document.createElement('tr')

        //subject column
        var td1 = document.createElement('td')
        var s = document.createElement('input')
        s.setAttribute('type','text')
        s.setAttribute('name',"s"+i.toString())
        s.setAttribute('placeholder',"Subject-"+i+" Name")
        s.setAttribute('required','')
        td1.appendChild(s)

        //faculty column
        var td2 = document.createElement('td')
        var f = document.createElement('input')
        f.setAttribute('type','text')
        f.setAttribute('name',"f"+i.toString())
        f.setAttribute('placeholder',"Faculty-"+i)
        f.setAttribute('required','')
        td2.appendChild(f)

        tr.appendChild(td1)
        tr.appendChild(td2)

        document.getElementById('addsubjects').appendChild(tr)
    }

    for(var i=1;i<=numLabs;i++){
        var tr = document.createElement('tr')

        //Lab column
        var td1 = document.createElement('td')
        var l = document.createElement('input')
        l.setAttribute('type','text')
        l.setAttribute('name',"l"+i.toString())
        l.setAttribute('placeholder',"Lab-"+i+" Name")
        l.setAttribute('required','')
        td1.appendChild(l)

        //Lab faculty column
        var td2 = document.createElement('td')
        var lf = document.createElement('input')
        lf.setAttribute('type','text')
        lf.setAttribute('name',"lf"+i.toString())
        lf.setAttribute('placeholder',"Lab Faculty-"+i)
        lf.setAttribute('required','')
        td2.appendChild(lf)

        tr.appendChild(td1)
        tr.appendChild(td2)

        document.getElementById('addsubjects').appendChild(tr)
    }

    var createbtn = document.createElement('button')
    createbtn.setAttribute('type','submit')
    createbtn.setAttribute('name','createbtn')
    createbtn.innerHTML = 'Create Feedback'

    document.getElementById('createbtn').appendChild(createbtn)
}