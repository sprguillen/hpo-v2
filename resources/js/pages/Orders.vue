<template>
  <div class="orders">
    <Header />
    <section>
      <div class="container-fluid main-container">
        <div class="column is-full page-content">
          <div class="column">
            <section>
              <h1 class="float-left">
              	<b-icon icon="stethoscope" />
                BATCH ORDERS
              </h1>
              <div class="tabs float-right">
                <b-field
									class="show-field" 
									horizontal 
									label="Show:"
								>
									<b-select 
										class="control" 
										placeholder="Select results"
									>
										<option value="1">
											10 results
										</option>
										<option value="2">
											30 results
										</option>
										<option value="3">
											50 results
										</option>
										<option value="3">
											100 results
										</option>
										<option value="3">
											All results
										</option>
									</b-select>
								</b-field>
								<b-field 
									horizontal 
									label="Filter:"
								>
									<b-select placeholder="Select a filter">
										<option value="1">
											Confirmed
										</option>
										<option value="2">
											Accomplished
										</option>
									</b-select>
								</b-field>
              </div>
              <div class="clearfix" />
							<div
								class="column portlet"
							>
								<component
									:is="activeTab"
									v-bind="dynamicProps"
								/>
							</div>
            </section>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import Header from '@/components/global/Header'
import BatchOrders from '@/components/orders/BatchOrders'

export default {
  components: {
    Header,
    BatchOrders
  },
  data() {
    return {
      batchOrdersList: [
        {
          batchNo: '658004958',
					tests: '2',
					patients: '1',
					totalCost: 'P 545.00',
					status: 'Confirmed',
					dateCreated: 'Jun 08 2019 06:39 am'
				},
				{
          batchNo: '658004951',
					tests: '1',
					patients: '1',
					totalCost: 'P 450.00',
					status: 'Confirmed',
					dateCreated: 'Jun 08 2019 02:33 am'
				},
				{
          batchNo: '658004935',
					tests: '1',
					patients: '1',
					totalCost: 'P 90.00',
					status: 'Confirmed',
					dateCreated: 'Jun 07 2019 01:30 am'
				},
				{
          batchNo: '658004932',
					tests: '2',
					patients: '1',
					totalCost: 'P 190.00',
					status: 'Confirmed',
					dateCreated: 'Jun 07 2019 12:11 am'
				},
				{
          batchNo: '658004927',
					tests: '4',
					patients: '2',
					totalCost: 'P 735.00',
					status: 'Confirmed',
					dateCreated: 'Jun 06 2019 09:06 pm'
				},
				{
          batchNo: '658004926',
					tests: '1',
					patients: '1',
					totalCost: 'P 95.00',
					status: 'Confirmed',
					dateCreated: 'Jun 06 2019 09:02 pm'
				}
			],
			activeTab: 'BatchOrders'
    }
  },
  computed: {
    dynamicProps() {
        return { batchOrders: this.batchOrdersList }
    }
  }
}
</script>
<style lang="scss" scoped>
  @import "../../sass/pages/orders.scss";
</style>
