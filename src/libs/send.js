const x = ""

export default {

    send_post_json(data, url, ondone, onerror) {
        let http = new XMLHttpRequest()
        http.open('POST', x + url, true)
        http.setRequestHeader("Content-Type", "aplication/json");
        http.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) ondone(this)
                else onerror(this)
            }
        }
        http.send(data)
    },

    send_post(url, ondone, onerror) {
        let http = new XMLHttpRequest()
        http.open('POST', x + url, true)
        http.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) ondone(this)
                else onerror(this)
            }
        }
        http.send()
    },

    send_get(url, ondone, onerror) {
        let http = new XMLHttpRequest()
        http.open('GET', x + url, true)
        http.onreadystatechange = function() {
            if (this.readyState === XMLHttpRequest.DONE) {
                if (this.status === 200) ondone(this)
                else onerror(this)
            } 
        }
        http.send()
    }

}