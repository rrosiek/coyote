<div class="columns">
    <div class="column">
        @include('partials.textInput', ['name' => 'title', 'label' => 'Title', 'value' => $event->name, 'required' => true])
    </div>
    <div class="column">
        @include('partials.textInput', ['name' => 'description', 'label' => 'Description', 'value' => $event->description])
    </div>
</div>
<div class="columns">
    <div class="column">
        <article class="message">
            <div class="message-header">
                <p>Start Date/Time (EST)</p>
            </div>
            <div class="message-body">
                <div class="columns">
                    <div class="column">
                        @include('partials.dateInput', ['name' => 'start_date', 'label' => 'Date', 'value' => $event->start_date, 'required' => true])
                    </div>
                    <div class="column">
                        @include('partials.selectInput', ['name' => 'start_hour', 'label' => 'Hour', 'values' => config('custom.hours'), 'value' => $event->start_date->setTimezone('America/New_York')->hour, 'required' => true])
                    </div>
                    <div class="column">
                        @include('partials.selectInput', ['name' => 'start_minute', 'label' => 'Minute', 'values' => config('custom.minutes'), 'value' => $event->start_date->setTimezone('America/New_York')->minute])
                    </div>
                </div>
            </div>
        </article>
    </div>
    <div class="column">
        <article class="message">
            <div class="message-header">
                <p>End Date/Time (EST)</p>
            </div>
            <div class="message-body">
                <div class="columns">
                    <div class="column">
                        @include('partials.dateInput', ['name' => 'end_date', 'label' => 'Date', 'value' => $event->end_date, 'required' => true])
                    </div>
                    <div class="column">
                        @include('partials.selectInput', ['name' => 'end_hour', 'label' => 'Hour', 'values' => config('custom.hours'), 'value' => $event->end_date->setTimezone('America/New_York')->hour, 'required' => true])
                    </div>
                    <div class="column">
                        @include('partials.selectInput', ['name' => 'end_minute', 'label' => 'Minute', 'values' => config('custom.minutes'), 'value' => $event->end_date->setTimezone('America/New_York')->minute])
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
<h5 class="title is-5">Recurrence</h5>
<div class="columns">
    <div class="column">
        @include('partials.selectInput', ['name' => 'frequency', 'label' => 'Every', 'values' => ['0' => '', 'daily' => 'Day', 'weekly' => 'Week', 'monthly' => 'Month'], 'value' => '0'])
    </div>
    <div class="column">
        @include('partials.selectInput', ['name' => 'by_day', 'label' => 'On', 'values' => config('custom.days'), 'value' => 'MO'])
    </div>
    <div class="column">
        @include('partials.selectInput', ['name' => 'interval', 'label' => 'On', 'values' => config('custom.days'), 'value' => 'SU'])
    </div>
</div>
