<?php

namespace App\Jobs;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Filler\FillerIdFilter;
use App\Repositories\FillerRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AnswerNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FormUpdateData $form;
    private FillerUpdateData $filler;

    public function __construct(
        FormUpdateData $form,
        FillerUpdateData $filler
    )
    {
        $this->form = $form;
        $this->filler = $filler;
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var FillerRepository */
        $fillerRepository = app(FillerRepository::class);

        $filler = $fillerRepository->getNotifiableInstance(new FillerIdFilter($this->filler->getId()));

        $filler->notify('mail');
    }
}