export default {
    get_week(date_time) {
        let data = []
        let times = new Date(date_time)
        times.setDate(times.getDate() - (times.getDay() == 0 ? 7 : times.getDay()) + 1)
        for(let i = 0; i < 7; i++) {
            data.push(new Date(times))
            times.setDate(times.getDate() + 1)
        }
        return data
    },

    from_date_to_week(daytime, daytime_end) {
        let data = [new Date(daytime.getFullYear(), daytime.getMonth(), daytime.getDate())]
        let times = new Date(daytime.getFullYear(), daytime.getMonth(), daytime.getDate())
        if (daytime.getDay() != 0) {
            for(let i = daytime.getDay() + 1; i <= new Date(daytime_end.getFullYear(), daytime_end.getMonth(), daytime_end.getDate()).getDay(); i++) {
                times.setDate(times.getDate() + 1)
                data.push(new Date(times))
            }
        }
        return data
    },

    last_day_of_week(daytime) {
        let date = new Date()
        this.get_week(daytime).forEach(e => {
            if (e.getDay() == 0) date = e
        })
        return date
    },

    get_first_and_last(daytime) {
        let time = new Date(daytime)
        time.setDate(time.getDate() - (time.getDay() === 0 ? 6 : time.getDay() - 1))
        return [time, this.last_day_of_week(time)]
    },

    compare_date(date_time, date_time_end) {
        if (date_time.getMonth() == date_time_end.getMonth() &&
            date_time.getFullYear() == date_time_end.getFullYear() &&
            date_time.getDate() == date_time_end.getDate()) return true
        else return false
    },

    is_in_week(time_data, date_week) {
        let check = false
        let vm = this
        this.get_week(new Date(date_week)).forEach((e) => {
            if (vm.compare_date(e, time_data)) check = true
        })
        return check
    },

    count_of_days(data_start, data_end) {
        let oned = 24 * 60 * 60 * 1000;
        oned = Math.ceil((data_start - data_end) / oned)
        if (oned < 0) oned = oned * -1
        return oned;
    }
}