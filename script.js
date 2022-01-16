function monthCalendar(m) {
    m = m - 1
    if (m < 0 || m > 11) return "<h3>error</h3>"
    var header = `
    <div
            class="calendar-archives arw-theme1 arw-theme2 calendrier pastel classiclight classicdark twentytwelve twentythirteen twentyfourteen twentyfourteenlight">
            <div class="calendar-navigation">
                <div class="menu-container months"><a class="title" href="javascript:{{func}}({{month}}, 0);">{{name}}</a></div>
            </div>
    
    `,
        rowHeader = '<div class="week-row">',
        day = `
        <span class="day has-posts last">
                    <a class="today" href="javascript:{{func}}({{month}}, {{i}});">{{i}}</a>
        </span>                
        `,
        noDay = '<span class="day noday last"> </span>',
        endTag = '</div>',
        mArray = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
        nArray = ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
        mst = header.replace("{{name}}", nArray[m]).replace('{{month}}', m + 1).replace('{{func}}', "FindPosts"),
        c = 0,
        tmp,
        today = new Date(),
        dd = today.getDate(),
        mm = today.getMonth() + 1;
    // console.log('Date:', dd, mm)
    for (var j = 0; j < 5; j++) {
        mst += rowHeader
        for (var i = 0; i < 7; i++) {
            c++
            if (c <= mArray[m]) tmp = day
            else tmp = noDay
            if (i != 6) tmp = tmp.replace('last', '')
            tmp = tmp.replace("{{name}}", nArray[m]).replace('{{month}}', m + 1).replace('{{func}}', "FindPosts").replace(/{{i}}/g, c)
            if (!(m + 1 == mm && c == dd)) tmp = tmp.replace('class="today"', '')
            mst += tmp
        }
        mst += endTag
    }
    mst += endTag
    // console.log('Q==============================')
    // console.log(mst)            
    // console.log('==============================')
    return mst
}

function fullCalendar() {
    var grid = `
    <div class="container99">
        <div class="row99">
            <div class="column99">                
                {{1}}
            </div>
            <div class="column99">                
                {{2}}
            </div>
            <div class="column99">                
                {{3}}
            </div>
        </div>
        <div class="row99">
            <div class="column99">                
                {{4}}
            </div>
            <div class="column99">                
                {{5}}
            </div>
            <div class="column99">                
                {{6}}
            </div>
       </div>
       <div class="row99">
            <div class="column99">                
                {{7}}
            </div>
            <div class="column99">                
                {{8}}
            </div>
            <div class="column99">                
                {{9}}
            </div>
       </div>
       <div class="row99">
            <div class="column99">                
                {{10}}
            </div>
            <div class="column99">                
                {{11}}
            </div>
            <div class="column99">                
                {{12}}
            </div>
       </div>
    </div>
    `
    for (var i = 1; i <= 12; i++)
        grid = grid.replace('{{' + i + '}}', monthCalendar(i))
    return grid
}


function FindPosts(m, d) {
    console.log(m + ' ' + d)
}
// console.log("-------------------------")
window.addEventListener('load', function () {
    var cldr = document.getElementById("cldr");
    //console.log(cldr)  
    cldr.innerHTML = fullCalendar()
})