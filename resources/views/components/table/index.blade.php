<div class="bg-neutral-primary-soft border border-default rounded-base overflow-hidden">

    @if(isset($toolbar))
    <div class="p-4 border-b border-default">
        {{ $toolbar }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs font-medium text-body-subtle uppercase bg-neutral-secondary border-b border-default">
                {{ $head }}
            </thead>
            <tbody class="divide-y divide-default">
                {{ $body }}
            </tbody>
        </table>
    </div>

    @if(isset($pagination))
    <div class="p-4 border-t border-default">
        {{ $pagination }}
    </div>
    @endif

</div>