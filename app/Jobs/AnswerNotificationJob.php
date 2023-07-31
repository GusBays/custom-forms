<?php

namespace App\Jobs;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Filters\Filler\FillerIdFilter;
use App\Filters\FormAnswer\FormAnswerFormIdFillerIdFilter;
use App\Notifications\Front\AnswerNotification;
use App\Repositories\FillerRepository;
use App\Repositories\FormAnswerRepository;
use Barryvdh\DomPDF\PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class AnswerNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FormUpdateData $form;
    private FillerUpdateData $filler;
    private FillerRepository $fillerRepository;
    private FormAnswerRepository $formAnswerRepository;

    public function __construct(
        FormUpdateData $form,
        FillerUpdateData $filler
    )
    {
        $this->form = $form;
        $this->filler = $filler;
        $this->fillerRepository = app(FillerRepository::class);
        $this->formAnswerRepository = app(FormAnswerRepository::class);
    }

    public function handle(): void
    {
        config(['organization_id' => $this->form->getOrganizationId()]);

        $filler = $this->fillerRepository->getNotifiableInstance(new FillerIdFilter($this->filler->getId()));

        $file = $this->putFileToStorageAndGetPath();

        $filler->notify(new AnswerNotification($this->filler, $this->form, $file));
    }

    private function putFileToStorageAndGetPath(): string
    {
        $organizationId = $this->form->getOrganizationId();
        $formId = $this->form->getId();
        $fileName = 'fomulario-' . $formId . '-preenchido-por-' . $this->filler->getName() . '.pdf';

        $pathToSaveFile  = "public/$organizationId/forms/$formId/$fileName";

        $pdf = $this->getPdfInstance();
        $pdf->loadView('pdf.form-filled', $this->getData());

        Storage::put($pathToSaveFile, $pdf->download("$fileName")->getOriginalContent());

        return "/$organizationId/forms/$formId/$fileName";
    }

    private function getData(): array
    {
        $answerFilter = new FormAnswerFormIdFillerIdFilter($this->form->getId(), $this->filler->getId());
        $answer = $this->formAnswerRepository->getOne($answerFilter);

        return [
            'filler' => $this->filler,
            'form' => $this->form,
            'answer' => $answer
        ];
    }

    private function getPdfInstance(): PDF
    {
        return app(PDF::class);
    }
}