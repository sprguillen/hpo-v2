import moment from 'moment'

function relativeTime(date) {
  return moment(date, 'YYYY-MM-DD hh:mm:ss').fromNow()
}

export { relativeTime }