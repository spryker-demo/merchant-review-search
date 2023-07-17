import { ChangeDetectionStrategy, Component, Input, ViewEncapsulation } from '@angular/core';
import { TableConfig } from '@spryker/table';

@Component({
    selector: 'mp-merchant-reviews-merchant-portal-table',
    templateUrl: './merchant-review-merchant-portal-table.component.html',
    styleUrls: ['./merchant-review-merchant-portal-table.component.less'],
    changeDetection: ChangeDetectionStrategy.OnPush,
    encapsulation: ViewEncapsulation.None,
    host: {
        class: 'mp-merchant-review-merchant-portal-table',
    },
})
export class MerchantReviewMerchantPortalTableComponent {
    @Input() config: TableConfig;
    @Input() tableId?: string;
}
