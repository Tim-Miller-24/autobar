<?php

namespace App\Cashbox\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Builder;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use App\Cashbox\Tools\PrinterItem;

class Order extends Model
{
    use HasFactory;
    use CrudTrait;

    const STATUS_PENDING = 'pending';
    const STATUS_CANCEL = 'cancel';
    const STATUS_FINISH = 'finish';

    const CACHE_KEY = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paid',
        'status'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Get the items for the category.
     */
    public function getItems(): Traversable
    {
        return $this->items;
    }

    public function scopePending(Builder $query)
    {
        return $query->whereIn('status', [Order::STATUS_PENDING]);
    }

    public function scopeFinish(Builder $query)
    {
        return $query->whereIn('status', [Order::STATUS_FINISH]);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function total()
    {
        return $this->items->sum('total');
    }

    public function profit()
    {
        return $this->items->sum('profit');
    }

    public function printReceipt()
    {
        try {
            $connector = new FilePrintConnector(env('PRINTER_PATH'));
            $printer = new Printer($connector);

            $items = [];
            /* Information for the receipt */
            foreach($this->items as $item)
            {
                $name = $item->option ? $item->item->name . ' ' . $item->option->name : $item->item->name;
                $items[] = new PrinterItem(
                    $name,
                    $item->quantity . ' x ' . $item->price
                );
            }

            /* Header */
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text(trans('custom.print.footer_text', ['name' => env('APP_NAME')]) . "\n");

            /* Date */
            $printer->selectPrintMode(Printer::MODE_FONT_B);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode();
            $printer->text($this->updated_at);
            $printer->feed(2);

            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text(trans('custom.print.invoice_list') . "\n");
            $printer->selectPrintMode();
            $printer->setEmphasis(false);
            $printer->feed();

            /* Items */
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);
            $printer->text(new PrinterItem(
                'Наименование',
                'Количество х Цена'
            ));
            $printer->setEmphasis(false);
            foreach ($items as $item) {
                $printer->text($item->getAsString(32)); // for 58mm Font A
            }
            $printer->setEmphasis(true);
            $printer->feed();


            /* Tax and total */
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text(trans('custom.print.total'). ' ' . $this->total());
            $printer->selectPrintMode();
            $printer->feed(5);

            /* Cut the receipt and open the cash drawer */
            $printer->cut();
            $printer->pulse();

            $printer->close();
        } catch (\Exception $e) {
            trigger_error($e->getMessage());
        }
    }
}
