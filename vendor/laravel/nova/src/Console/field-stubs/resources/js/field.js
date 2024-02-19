Nova.booting((Vue, router, store) => {
  Vue.component(
    'index-{{ component }}',
    require('./components/IndexField').default
  )
  Vue.component(
    'detail-{{ component }}',
    require('./components/DetailField').default
  )
  Vue.component(
    'form-{{ component }}',
    require('./components/FormField').default
  )
})
