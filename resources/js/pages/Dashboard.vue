<template>
  <div class="dashboard">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column is-full no-left-padding">
            <h1 class="float-left">HI-PRECISION ORDERING SYSTEM</h1>
            <nav class="breadcrumb float-right has-bullet-separator" aria-label="breadcrumbs">
              <ul>
                <li><a>HOME</a></li>
                <li class="active">DASHBOARD</li>
              </ul>
            </nav>
          </div>
          <div class="column" />
          <div class="column" />
          <div class="column">
            <div class="columns">
              <div class="column is-half side-borders">
                <BatchOrders :orders="draftOrders" type="Draft" />
              </div>
              <div class="column">
                <TestAnnouncements :announcements="announcements" />
              </div>
            </div>
          </div>
          <div class="column">
            <div class="columns">
              <div class="column is-half side-borders">
                <BatchOrders :orders="confirmedOrders" type="Confirmed" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Header from '@/components/global/Header'
import BatchOrders from '@/components/dashboard/BatchOrders'
import TestAnnouncements from '@/components/dashboard/TestAnnouncements'

export default {
  components: {
    Header,
    BatchOrders,
    TestAnnouncements
  },
  data() {
    const draftOrders = [
      { batchNo: '658003024', numberOfTests: 1, numberOfPatients: 1, totalCost: '500.00', status: 'Draft' },
      { batchNo: '658002961', numberOfTests: 1, numberOfPatients: 1, totalCost: '1,800.00', status: 'Draft' }
    ]

    const confirmedOrders = [
      { batchNo: '658004046', numberOfTests: 2, numberOfPatients: 2, totalCost: '4,400.00', status: 'Confirmed' },
      { batchNo: '658004045', numberOfTests: 2, numberOfPatients: 1, totalCost: '1,800.00', status: 'Confirmed' }
    ]

    const announcements = [
      { topic: 'Release of results' },
      { topic: 'Holiday schedules' },
      { topic: 'Patients Beware' },
      { topic: 'New Tests' },
      { topic: 'Management Announcement' },
      { topic: 'What`s hot' },
      { topic: 'New Facilities' },
      { topic: 'Doctor Lists' },
      { topic: 'Announcement!' }
    ]

    return {
      draftOrders,
      confirmedOrders,
      announcements
    }
  },
  created() {
    this.$toasted.success('Welcome')
  }
}
</script>
<style lang="scss" scoped>
  @import "../../sass/pages/dashboard.scss";
</style>
