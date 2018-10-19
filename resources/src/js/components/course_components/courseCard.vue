<template>
    <div>
        <div class="panel">
                    <div>
                        <div class="panelHeader__info">
                            <router-link :to="'/class/'+course.id">{{course.title}}</router-link>
                        </div>
                    </div>
                    <div class="panel__content">
                        {{course.subject}} {{course.catalog_number}}: #{{course.id}}
                        {{classStartTime}} - {{classEndTime}}
                    </div>
                    <div>
                        {{course.meetings[0].location}} {{course.meetings[0].days}}
                    </div>
                    <div>
                        {{course.enrollment_count}} Students
                    </div>
            </div>
    </div>
</template>

<script>
export default {
  name: 'course-card',

  data() {
    return {
      show: true,
      messages: true,
      errors: [],
    };
  },

  props: ['course'],

  computed: {
    classStartTime() {
      return this.convertTime(this.course.meetings[0].start_time);
    },

    classEndTime() {
      return this.convertTime(this.course.meetings[0].end_time);
    },
  },

  methods: {
    convertTime(OriginalTime) {
      let time = OriginalTime;
      let hour = parseInt(time.substring(0, 2));
      let min = `${time.substring(2, 4)}am`;
      if (hour > 12) {
        hour -= 12;
        min = `${min.substring(0, 2)}pm`;
      }
      time = `${hour}:${min}`;
      return time;
    },
  },

};
</script>
