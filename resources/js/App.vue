<template>
    <div>
        <Navigation></Navigation>
        <Invoices></Invoices>
        <Footer></Footer>
    </div>
</template>

<script>
  import Navigation from './partials/Navigation.vue';
  import Footer from './partials/Footer.vue';
  import Invoices from './pages/Invoices.vue';

  export default {
    components: {
      Navigation,
      Footer,
      Invoices
    }
  }
</script>