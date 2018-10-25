export const convertCourseData = {
    methods: {
        convertTime(OriginalTime) {
        let time = OriginalTime;
        let hour = parseInt(time.substring(0, 2));
        let min = `${time.substring(2, 4)} a.m.`;
        if (hour > 12) {
            hour -= 12;
            min = `${min.substring(0, 2)} p.m.`;
        }
        time = `${hour}:${min}`;
        return time;
        },

        convertDays(originalDays) {
        const days = originalDays;
        const split = days.split('');

        // M T W R F S
        // Mo Tu We Th Fr Sa
        const result = split.map((day) => {
            if (day === 'M') day = 'Mo';
            if (day === 'T') day = 'Tu';
            if (day === 'W') day = 'We';
            if (day === 'R') day = 'Th';
            if (day === 'F') day = 'Fr';
            if (day === 'S') day = 'Sa';
            return day;
        });

        return result.join('');
        },
    }
}