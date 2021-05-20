function myFunction() {
    let x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }


  // get month as three 3 letter abbr (where n is the current index user want)
const getMonth = (val = 0) => {
  const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
  let d = new Date();
  let n = d.getMonth();
  n += val; 
  if (n < 0) {
    while (n < 0) {
      n +=12; 
    }
  }else if (n > 11) {
    while (n > 11) {
      n -= 12; 
    }
  } else {
    n =n;
  }
  return months[n];
  }


      // get month as three 3 letter abbr (where n is the current index user want)
      const getDay = (val = 0) => {
        const days = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"];
        let d = new Date();
        let n = d.getDay()-1;
        n += val; 
        if (n < 0) {
          while (n < 0) {
            n +=7; 
          }
        }else if (n > 6) {
          while (n > 6) {
            n -= 7; 
          }
        } else {
          n =n;
        }
        return days[n];
        }

        //// get time difference
    function get_time_diff(date, start, end) {

      let time_start = new Date(`${date} ${start}`);
      let time_end = new Date(`${date} ${end}`);

      let time_diff = Math.abs(time_start.getTime() - time_end.getTime());

      let hh =Math.floor(time_diff/1000/60/60);
          hh = ('0'+hh).slice(-2);

          time_diff -= hh *1000 * 60 * 60;
      let mm =Math.floor(time_diff/1000/60);
          mm = ('0'+mm).slice(-2);

          time_diff -= mm *1000 * 60;
      let ss =Math.floor(time_diff/1000);
          ss = ('0'+ss).slice(-2);

      return hh+":"+mm+":"+ss;
  }

        
