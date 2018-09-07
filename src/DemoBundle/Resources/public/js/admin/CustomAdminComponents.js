import LinkedListView from './LinkedList/LinkedListView';

const admin = {
  install(Vue) {
    Vue.component('linked-list-view', LinkedListView);
  }
};

window.admin = Object.assign(window.admin || {}, admin);
