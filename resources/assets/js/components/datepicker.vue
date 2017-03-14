<template>
    <!-- Credit to https://github.com/charliekassel/vuejs-datepicker, modified from source -->
    <div class="datepicker">
        <input
            :class="inputClass"
            :name="name"
            :id="id"
            @click="showCalendar"
            :value="formattedValue"
            :placeholder="placeholder"
            readonly
        >
        <div class="card calendar" :style="calendarStyle" v-show="showDayView">
            <header class="card-header">
                <a @click="previousMonth" class="card-header-icon prev">
                    <span class="icon">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </a>
                <p @click="showMonthCalendar">{{ currMonthName }} {{ currYear }}</p>
                <a @click="nextMonth" class="card-header-icon next">
                    <span class="icon">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
            </header>
            <div class="card-content">
                <div class="columns">
                    <div class="column cell day-header" v-for="d in daysOfWeek">{{ d }}</div>
                </div>
                <div class="columns" v-for="(week, index) in weeks" :key="index">
                    <div
                        @click="selectDate(day)"
                        :class="{ 'blank': !day.timestamp, 'selected': day.isSelected }"
                        class="column cell day"
                        v-for="day in week"
                        :key="day.timestamp"
                    >
                        {{ day.date }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card calendar" v-show="showMonthView">
            <header class="card-header">
                <a @click="previousYear" class="card-header-icon prev">
                    <span class="icon">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </a>
                <p @click="showYearCalendar">{{ getYear }}</p>
                <a @click="nextYear" class="card-header-icon next">
                    <span class="icon">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
            </header>
            <div class="card-content">
                <div class="columns">
                    <div
                        @click.stop="selectMonth(months[n - 1])"
                        :class="{ 'selected': months[n - 1].isSelected }"
                        class="column cell month"
                        v-for="n in 3"
                    >
                        {{ months[n - 1].month }}
                    </div>
                </div>
                <div class="columns">
                    <div
                        @click.stop="selectMonth(months[n + 2])"
                        :class="{ 'selected': months[n + 2].isSelected }"
                        class="column cell month"
                        v-for="n in 3"
                    >
                        {{ months[n + 2].month }}
                    </div>
                </div>
                <div class="columns">
                    <div
                        @click.stop="selectMonth(months[n + 5])"
                        :class="{ 'selected': months[n + 5].isSelected }"
                        class="column cell month"
                        v-for="n in 3"
                    >
                        {{ months[n + 5].month }}
                    </div>
                </div>
                <div class="columns">
                    <div
                        @click.stop="selectMonth(months[n + 8])"
                        :class="{ 'selected': months[n + 8].isSelected }"
                        class="column cell month"
                        v-for="n in 3"
                    >
                        {{ months[n + 8].month }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card calendar" v-show="showYearView">
            <header class="card-header">
                <a @click="previousDecade" class="card-header-icon prev">
                    <span class="icon">
                        <i class="fa fa-angle-left"></i>
                    </span>
                </a>
                <p>{{ getDecade }}</p>
                <a @click="nextDecade" class="card-header-icon next">
                    <span class="icon">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
            </header>
            <div class="card-content">
                <div class="columns">
                    <div
                        @click.stop="selectYear(years[n - 1])"
                        :class="{ 'selected': years[n - 1].isSelected }"
                        class="column cell year"
                        v-for="n in 3"
                    >
                        {{ years[n - 1].year }}
                    </div>
                </div>
                <div class="columns">
                    <div
                        @click.stop="selectYear(years[n + 2])"
                        :class="{ 'selected': years[n + 2].isSelected }"
                        class="column cell year"
                        v-for="n in 3"
                    >
                        {{ years[n + 2].year }}
                    </div>
                </div>
                <div class="columns">
                    <div
                        @click.stop="selectYear(years[n + 5])"
                        :class="{ 'selected': years[n + 5].isSelected }"
                        class="column cell year"
                        v-for="n in 3"
                    >
                        {{ years[n + 5].year }}
                    </div>
                </div>
                <div class="columns">
                    <div class="column"></div>
                    <div
                        @click.stop="selectYear(years[9])"
                        :class="{ 'selected': years[9].isSelected }"
                        class="column cell year"
                    >
                        {{ years[9].year }}
                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        blankDays () {
            return new Date(this.currentMonth).getDay()
        },
        calendarStyle () {
            let elSize = {
                top: 0,
                height: 0
            }

            if (this.$el) elSize = this.$el.getBoundingClientRect()
            
            let heightNeeded = elSize.top + elSize.height + this.calendarHeight || 0
            let styles = {}

            if (heightNeeded > window.innerHeight) {
                styles = {
                    'bottom': elSize.height + 'px'
                }
            }

            return styles
        },
        currMonthName () {
            let d = new Date(this.currentMonth)

            return this.monthsOfYear[d.getMonth()]
        },
        currYear () {
            return new Date(this.currentMonth).getFullYear()
        },
        formattedValue () {
            if (!this.selectedDate) return null

            return this.selectedDate.toLocaleDateString()
        },
        isOpen () {
            return this.showDayView || this.showMonthView || this.showYearView
        },
        getDecade () {
            let sD = Math.floor(new Date(this.currentMonth).getFullYear() / 10) * 10

            return sD + '\'s'
        },
        getYear () {
            return new Date(this.currentMonth).getFullYear()
        },
        months () {
            let d = new Date(this.currentMonth)
            let months = []
            let jan = new Date(d.getFullYear(), 0, d.getDate(), d.getHours(), d.getMinutes())

            for (let i = 0; i < 12; i++) {
                months.push({
                    month: this.monthsOfYear[i],
                    timestamp: jan.getTime(),
                    isSelected: this.isSelectedMonth(jan)
                })

                jan.setMonth(jan.getMonth() + 1)
            }

            return months
        },
        weeks () {
            let d = new Date(this.currentMonth)
            let days = []
            let weeks = []
            let weekCount = 1
            let startDay = d.getDay()
            let endDay = new Date(d.getFullYear(), d.getMonth() + 1, 0).getDay()
            let daysInMonth = new Date(d.getFullYear(), d.getMonth() + 1, 0).getDate()
            let empty = { date: null, timestamp: null, isSelected: null }

            for (let i = 0; i < daysInMonth; i++) {
                if (weekCount === 1) {
                    for (let b = 0; b < startDay; b++) {
                        days.push(Object.assign({}, empty))
                        weekCount++
                    }
                }

                days.push({
                    date: d.getDate(),
                    timestamp: d.getTime(),
                    isSelected: this.isSelectedDate(d),
                })

                if (weekCount % 7 === 0) {
                    weeks.push(days)
                    days = []
                }

                d.setDate(d.getDate() + 1)
                weekCount++
            }

            if (endDay < 6) {
                for (let x = endDay; x < 6; x++) {
                    days.push(Object.assign({}, empty))
                }

                weeks.push(days) 
            }

            return weeks
        },
        years () {
            let d = new Date(this.currentMonth)
            let years = []
            let y = new Date(Math.floor(d.getFullYear() / 10) * 10, d.getMonth(), d.getDate(), d.getHours(), d.getMinutes())

            for (let i = 0; i < 10; i++) {
                years.push({
                    year: y.getFullYear(),
                    timestamp: y.getTime(),
                    isSelected: this.isSelectedYear(y),
                })

                y.setFullYear(y.getFullYear() + 1)
            }
      
            return years
        }
    },
    data () {
        return {
            currentMonth: new Date(new Date().getFullYear(), new Date().getMonth(), 1).getTime(),
            daysOfWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            monthsOfYear: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            selectedDate: null,
            showDayView: false,
            showMonthView: false,
            showYearView: false,
            calendarHeight: 0
        }
    },
    methods: {
        close () {
            this.showDayView = this.showMonthView = this.showYearView = false
        },
        isSelectedDate (date) {
            return this.selectedDate && this.selectedDate.toDateString() === date.toDateString()
        },
        isSelectedMonth (date) {
            return (this.selectedDate &&
                this.selectedDate.getFullYear() === date.getFullYear() &&
                this.selectedDate.getMonth() === date.getMonth()
            )
        },
        isSelectedYear (date) {
            return this.selectedDate && this.selectedDate.getFullYear() === date.getFullYear()
        },
        nextDecade () {
            let d = new Date(this.currentMonth)

            d.setYear(d.getFullYear() + 10)
            this.currentMonth = d.getTime()
        },
        nextMonth () {
            let d = new Date(this.currentMonth)
            let daysInMonth = new Date(Date.UTC(d.getFullYear(), d.getMonth() + 1, 0)).getUTCDate()

            d.setDate(d.getDate() + daysInMonth)
            this.currentMonth = d.getTime()
        },
        nextYear () {
            let d = new Date(this.currentMonth)

            d.setYear(d.getFullYear() + 1)
            this.currentMonth = d.getTime()
        },
        previousMonth () {
            let d = new Date(this.currentMonth)

            d.setMonth(d.getMonth() - 1)
            this.currentMonth = d.getTime()
        },
        previousYear () {
            let d = new Date(this.currentMonth)

            d.setYear(d.getFullYear() - 1)
            this.currentMonth = d.getTime()
        },
        previousDecade () {
            let d = new Date(this.currentMonth)

            d.setYear(d.getFullYear() - 10)
            this.currentMonth = d.getTime()
        },
        showCalendar () {
            if (this.isOpen) return this.close()

            this.showDayCalendar()
        },
        setDate (timestamp) {
            this.selectedDate = new Date(timestamp)
            this.currentMonth = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), 1).getTime()
        },
        selectDate (day) {
            if (!day.timestamp) return

            this.setDate(day.timestamp)
            this.close()
        },
        selectMonth (month) {
            this.currentMonth = month.timestamp
            this.showDayCalendar()
        },
        selectYear (year) {
            this.currentMonth = year.timestamp
            this.showMonthCalendar()
        },
        showDayCalendar () {
            this.close()
            this.showDayView = true
        },
        showMonthCalendar () {
            this.close()
            this.showMonthView = true
        },
        showYearCalendar () {
            this.close()
            this.showYearView = true
        }
    },
    mounted () {
        let calendar = this.$el.querySelector('.calendar')

        if (this.value) {
            // Format input can be YYYY-MM-DD or M/D/YYYY
            if (this.value.includes('-')) {
                let parsed = this.value.split(' ')[0].split('-')
                this.selectedDate = new Date(parsed[0], parsed[1] - 1, parsed[2])
            } else {
                let parsed = this.value.split('/')
                this.selectedDate = new Date(parsed[2], parsed[0] - 1, parsed[1])
            }

            this.currentMonth = new Date(this.selectedDate.getFullYear(), this.selectedDate.getMonth(), 1).getTime()
        }

        this.$nextTick(() => {
            if (calendar) {
                this.calendarHeight = calendar.getBoundingClientRect().height
            }
        })

        document.addEventListener('click', (e) => {
            if (this.$el && !this.$el.contains(e.target)) this.close()
        }, false)
    },
    props: {
        id: {
            type: String
        },
        inputClass: {
            type: String
        },
        name: {
            type: String
        },
        placeholder: {
            type: String
        },
        value: {
            type: String
        }
    }
}
</script>
