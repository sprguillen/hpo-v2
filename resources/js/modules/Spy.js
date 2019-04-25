import Vue from 'vue';

export default class Spy
{
    constructor(namespace = '')
    {
        this.namespace = namespace;
        this.vue = new Vue();
    }

    /**
     * Emit/Fire an event
     *
     * @param  {String} event                   the event to fire/emit
     * @param  {Object} [data={}]               the event payload/data
     * @return {void}
     * @author {goper}
     */
    emit(event, data = {})
    {
        this.vue.$emit(this.resolveNamespace(event), data);
    }

    /**
     * Listen to event
     *
     * @param  {String}   event                 the event strong to listen with
     * @param  {Function} callback              the callback for the event
     * @return {void}
     * @author {goper}
     */
    on(event, callback)
    {
        this.vue.$on(this.resolveNamespace(event), callback);
    }

    /**
     * Resolve namespace
     *
     * @param {String} event
     * @return {String}
     * @author {goper}
     */
    resolveNamespace(event)
    {
        if (this.namespace.length) {
            return [this.namespace, event].join('.');
        }

        return event;
    }
}
