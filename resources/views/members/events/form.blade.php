<div class="columns">
    <div class="column">
        @include('partials.textInput', ['name' => 'title', 'label' => 'Title', 'value' => $event->title, 'required' => true])
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'detail', 'label' => 'Details', 'value' => $event->detail])
    </div>
</div>
<div class="columns">
    <div class="column">
        <article class="message">
            <div class="message-header">
                <p>Start Date/Time (Eastern)</p>
            </div>
            <div class="message-body">
                <div class="columns">
                    <div class="column">
                        @include('partials.dateInput', ['name' => 'start_date', 'label' => 'Date', 'value' => $event->start_date, 'required' => true])
                    </div>
                    <div class="column">
                        @include('partials.selectInput', ['name' => 'start_time', 'label' => 'Time', 'values' => config('custom.time'), 'value' => $start_time, 'required' => true])
                    </div>
                </div>
            </div>
        </article>
    </div>
    <div class="column">
        <article class="message">
            <div class="message-header">
                <p>End Date/Time (Eastern)</p>
            </div>
            <div class="message-body">
                <div class="columns">
                    <div class="column">
                        @include('partials.dateInput', ['name' => 'end_date', 'label' => 'Date', 'value' => $event->end_date])
                    </div>
                    <div class="column">
                        @include('partials.selectInput', ['name' => 'end_time', 'label' => 'Time', 'values' => config('custom.time'), 'value' => $end_time])
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
<h5 class="title is-5">Recurrence</h5>
<div class="columns">
    <div class="column">
        @include('partials.selectInput', ['name' => 'frequency', 'label' => 'Frequency', 'values' => ['' => '', 'DAILY' => 'Daily', 'WEEKLY' => 'Weekly', 'MONTHLY' => 'Monthly'], 'value' => $event->frequency])
        <p><em>The type of frequency for recurrence.</em></p>
    </div>
    <div class="column">
        @include('partials.dateInput', ['name' => 'until', 'label' => 'Until', 'value' => $event->until])
        <p><em>The date the event should stop recurring.</em></p>
    </div>
    <div class="column">
        @include('partials.selectInput', ['name' => 'by_day', 'label' => 'By Day', 'values' => config('custom.days'), 'value' => $event->by_day])
        <p><em>The day of the week to apply the recurring event.</em></p>
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'interval', 'label' => 'Interval', 'value' => $event->interval])
        <p><em>The interval between each frequency iteration.  For example, when using monthly, an interval of 2 means once every two months.</em></p>
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'set_position', 'label' => 'Set Position', 'value' => $event->set_position])
        <p><em>The Nth occurrence(s) inside the frequency period.  For example, a frequency of monthly, by day of Tuesday, and a Set Position of 3 will create an event on the third Tuesday of every month.</em></p>
    </div>
</div>
