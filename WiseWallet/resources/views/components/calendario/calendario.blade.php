<!-- resources/views/components/calendar.blade.php -->
<div>
    <div x-data="calendarComponent()" class="relative">
        <input name="Inputcalendario" id="calendario" type="text" readonly x-model="selectedDate" @click="showCalendar = !showCalendar"
            class="border border-gray-300 p-2 rounded w-full cursor-pointer" placeholder="Selecciona una fecha"/>

        <div x-show="showCalendar" @click.away="showCalendar = false"
            class="absolute bg-white border mt-2 p-4 rounded shadow-lg">
            <div class="flex justify-between mb-4">
                <button @click="previousMonth" class="p-1 rounded bg-gray-200">Anterior</button>
                <span x-text="monthNames[currentMonth] + ' ' + currentYear"></span>
                <button @click="nextMonth" class="p-1 rounded bg-gray-200">Siguiente</button>
            </div>
            <div class="grid grid-cols-7 gap-1">
                <template x-for="day in daysOfWeek" :key="day">
                    <div class="text-center font-bold" x-text="day"></div>
                </template>
            </div>
            <div class="grid grid-cols-7 gap-1">
                <template x-for="day in emptyDays" :key="day">
                    <div></div>
                </template>
                <template x-for="day in daysInMonth" :key="day">
                    <div @click="selectDate(day)" x-text="day"
                        :class="{ 'bg-blue-500 text-white': isToday(day), 'cursor-pointer hover:bg-blue-200': true }"
                        class="text-center p-2 rounded"></div>
                </template>
            </div>
        </div>
    </div>

    @push('js')
        <script>
            function calendarComponent() {
                return {
                    showCalendar: false,
                    selectedDate: '',
                    currentMonth: new Date().getMonth(),
                    currentYear: new Date().getFullYear(),
                    daysOfWeek: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                        'Octubre', 'Noviembre', 'Diciembre'
                    ],
                    daysInMonth: [],
                    emptyDays: [],
                    init() {
                        this.getDaysInMonth();
                    },
                    getDaysInMonth() {
                        const daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
                        const startDay = new Date(this.currentYear, this.currentMonth, 1).getDay();

                        this.daysInMonth = Array.from({
                            length: daysInMonth
                        }, (v, k) => k + 1);
                        this.emptyDays = Array.from({
                            length: startDay
                        }, (v, k) => k);
                    },
                    selectDate(day) {
                        this.selectedDate = new Date(this.currentYear, this.currentMonth, day).toLocaleDateString();
                        this.showCalendar = false;
                    },
                    isToday(day) {
                        const today = new Date();
                        return day === today.getDate() && this.currentMonth === today.getMonth() && this.currentYear === today
                            .getFullYear();
                    },
                    previousMonth() {
                        if (this.currentMonth === 0) {
                            this.currentMonth = 11;
                            this.currentYear--;
                        } else {
                            this.currentMonth--;
                        }
                        this.getDaysInMonth();
                    },
                    nextMonth() {
                        if (this.currentMonth === 11) {
                            this.currentMonth = 0;
                            this.currentYear++;
                        } else {
                            this.currentMonth++;
                        }
                        this.getDaysInMonth();
                    }
                }
            }
        </script>
    @endpush

</div>
