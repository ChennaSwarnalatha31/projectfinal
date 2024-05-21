var params = ['Has the Teacher covered entire Syllabus as prescribed by University?', 'Does the teacher come to class in time?', 'Does the teacher have command on the subject?', 'Does the teacher write and draw legibly on black board?', 'Does the teacher speak clearly and audibly?', 'Does the teacher, encourage, compliment and praise originally and creativity displayed by the students?', 'Is the teacher prompt valuing and returning the answer scripts providing feedback on performance?', 'Is the teacher available beyond normal classes to solve doubts?', 'Does the teacher maintain discipline in the classroom?', 'Overall rating of the teacher'];

function createfbform(noOfCols){
    for(var i=0;i<params.length;i++){
        var tr = document.createElement('tr')

        var td1 = document.createElement('td')
        td1.innerHTML = params[i]
        td1.setAttribute('align','left')
        tr.appendChild(td1)

        for(var j=0;j<noOfCols;j++){
            var td2 = document.createElement('td')
            td2.setAttribute('align','center')
            var select = document.createElement('select')
            select.setAttribute('name','r'+i.toString()+j.toString())
            select.setAttribute('required','')
            select.style.cssText = "width: 40px;height: 25px;"
            var op = document.createElement('option')
            op.setAttribute('value','')
            op.setAttribute('disabled','')
            op.setAttribute('selected','')
            op.innerHTML = ''
            select.appendChild(op)
            for(var k=5;k>=1;k--){
                var op2 = document.createElement('option')
                op2.setAttribute('value',k)
                op2.innerHTML = k
                select.appendChild(op2)
            }
            td2.appendChild(select)
            tr.appendChild(td2)
        }
        document.getElementById('fbform').appendChild(tr)
    }
}