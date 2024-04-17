<?php

namespace App\Livewire\Discord\Webhook;

use App\Models\DiscordWebhook;
use Livewire\Component;

class Index extends Component
{

    public $editId = null;
    public $name = null;
    public $discord_webhook = null;
    public $discord_channel_id = null;
    public $discord_category_id = null;
    public $webhooks = [];
    public $inCreation = false;
    protected $rules = [
        'webhooks.*.discord_webhook' => 'string',
        'webhooks.*.name' => 'required',
        'webhooks.*.discord_channel_id' => 'integer',
        'webhooks.*.discord_category_id' => 'integer',
        'name' => 'string|required',
        'discord_webhook' => 'string',
        'discord_channel_id' => 'integer',
        'discord_category_id' => 'integer',
    ];

    protected $messages = [
        'webhooks.*.name.required' => 'Nom obligatoire',
        'webhooks.*.discord_channel_id.required' => 'Channel obligatoire',
        'webhooks.*.discord_category_id.required' => 'Category obligatoire',
        'webhooks.*.discord_webhook.required' => 'Url obligatoire',
        'webhooks.*.discord_channel_id.integer' => 'Le Channel ID ne peut pas contenir de lettre',
        'webhooks.*.discord_category_id.integer' => 'Le Category ID ne peut pas contenir de lettre',
        'name.required' => 'Nom obligatoire',
        'discord_webhook.string' => 'Url obligatoire',
        'discord_channel_id.integer' => 'Le Channel ID ne peut pas contenir de lettre',
        'discord_category_id' => 'Le Category ID ne peut pas contenir de lettre',
    ];
    public function mount()
    {
        $this->webhooks = DiscordWebhook::all()->toArray();
    }
    public function render()
    {
        return view('livewire.discord.webhook.index', ['webhooks' => $this->webhooks]);
    }

    public function edit($id)
    {
        $this->editId = $id;
    }

    public function updateWebhook($id)
    {
        $this->validate();
        $webhook = $this->webhooks[$id] ?? NULL;
        if(!is_null($webhook))
        {
            $editedWebhook = DiscordWebhook::find($webhook['id']);
            if($editedWebhook)
            {
                $editedWebhook->update($webhook);
                toastify()->success('Webhook updated successfully!');
                return redirect(route('webhook'));
            }else{
                toastify()->error('Webhook not found');
                return redirect()->route('webhook');
            }
        }else{
            toastify()->error('Webhook not found');
            return redirect()->route('webhook');
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function delete($id)
    {
        $webhook = DiscordWebhook::find($id);
        if($webhook)
            $webhook->delete();
        toastify()->success('Webhook deleted successfully!');
        return redirect(route('webhook'));
    }

    public function create()
    {
        $this->inCreation = !$this->inCreation;
    }

    public function save()
    {
        DiscordWebhook::create([
            'name' => $this->name,
            'discord_channel_id' => $this->discord_channel_id,
            'discord_category_id' => $this->discord_category_id,
            'discord_webhook' => $this->discord_webhook,
        ]);
        toastify()->success('Webhook created successfully!');
        return redirect(route('webhook'));
    }
}
