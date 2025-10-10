import { TrendingDownIcon, TrendingUpIcon } from "lucide-react";

import { Badge } from "@/components/ui/badge";
import {
    Card,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";

export function SectionCards({
    totalRevenue,
    totalPaymentThisWeek,
    totalAdminsThisMonth,
    totalCustomersThisMonth,
    totalHostsThisMonth,
    totalGuestsThisMonth,
}) {
    return (
        <div className="*:data-[slot=card]:shadow-xs @xl/main:grid-cols-2 @5xl/main:grid-cols-4 grid grid-cols-1 gap-4 px-4 *:data-[slot=card]:bg-gradient-to-t *:data-[slot=card]:from-primary/5 *:data-[slot=card]:to-card dark:*:data-[slot=card]:bg-card lg:px-6">
            <Card className="@container/card">
                <CardHeader className="relative">
                    <CardDescription>Total Revenue</CardDescription>
                    <CardTitle className="@[250px]/card:text-3xl text-2xl font-semibold tabular-nums">
                        ${totalRevenue ?? "0.00"}
                    </CardTitle>
                </CardHeader>
                <CardFooter className="flex-col items-start gap-1 text-sm">
                    <div className="line-clamp-1 flex gap-2 font-medium">
                        Trending up <TrendingUpIcon className="size-4" />
                    </div>
                    <div className="text-muted-foreground">
                        Total payment of this week {totalPaymentThisWeek}
                    </div>
                </CardFooter>
            </Card>
            <Card className="@container/card">
                <CardHeader className="relative">
                    <CardDescription>New Users</CardDescription>
                    <CardTitle className="@[250px]/card:text-3xl text-2xl font-semibold tabular-nums">
                        Total Users this month : {totalCustomersThisMonth}
                    </CardTitle>
                </CardHeader>
                <CardFooter className="flex-col items-start gap-1 text-sm">
                    <div className="line-clamp-1 flex gap-2 font-medium">
                        Total Admins :
                        <div className="text-muted-foreground">
                            {totalAdminsThisMonth}
                        </div>
                    </div>
                    <div className="line-clamp-1 flex gap-2 font-medium">
                        Total Hosts :
                        <div className="text-muted-foreground">
                            {totalHostsThisMonth}
                        </div>
                    </div>
                    <div className="line-clamp-1 flex gap-2 font-medium">
                        Total Guests :
                        <div className="text-muted-foreground">
                            {totalGuestsThisMonth}
                        </div>
                    </div>
                </CardFooter>
            </Card>
        </div>
    );
}
