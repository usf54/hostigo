import { AppSidebar } from "@/components/app-sidebar";
import { SectionCards } from "@/components/section-cards";
import { SiteHeader } from "@/components/site-header";
import { SidebarInset, SidebarProvider } from "@/components/ui/sidebar";
import DynamicDataTable from "@/components/DynamicDataTable";
import { Toaster, toast } from "react-hot-toast";
import { useEffect } from "react";
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

export default function Page({
    latestUsers,
    totalRevenue,
    totalPaymentThisWeek,
    totalAdminsThisMonth,
    totalCustomersThisMonth,
    totalHostsThisMonth,
    totalGuestsThisMonth,
    auth
}) {
    useEffect(() => {
        const isAdmin = auth?.user?.role === 'admin';

        if (isAdmin) {
            if (typeof window !== 'undefined') {
                window.Pusher = Pusher;
            }
            
            const echo = new Echo({
                broadcaster: 'pusher',
                key: import.meta.env.VITE_PUSHER_APP_KEY,
                cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
                forceTLS: true,
                authEndpoint: '/broadcasting/auth',
                auth: {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                },
            });

            const channel = echo.private('admin.dashboard');
            
            // Listen for the event with dot prefix (as shown in your logs)
            channel.listen('.NewUserRegistered', (e) => {
                toast.success(`New user registered!`, {
                    description: `${e.user.name} just signed up.`,
                    duration: 3000,
                });
            });

            // Fallback without dot prefix
            channel.listen('NewUserRegistered', (e) => {
                toast.success(`New user registered!`, {
                    description: `${e.user.name} just signed up.`,
                    duration: 3000,
                });
            });

            window.laravelEcho = echo;
        }
        
        return () => {
            if (window.laravelEcho) {
                window.laravelEcho.leave('admin.dashboard');
                delete window.laravelEcho;
            }
        };
    }, [auth]);

    return (
        <SidebarProvider>
            <AppSidebar variant="inset" />
            <SidebarInset>
                <SiteHeader />
                <Toaster 
                    position="top-right"
                    expand={true}
                    richColors
                    closeButton
                />
                <div className="flex flex-1 flex-col">
                    <div className="@container/main flex flex-1 flex-col gap-2">
                        <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                            <SectionCards
                                totalRevenue={totalRevenue}
                                totalPaymentThisWeek={totalPaymentThisWeek}
                                totalAdminsThisMonth={totalAdminsThisMonth}
                                totalCustomersThisMonth={
                                    totalCustomersThisMonth
                                }
                                totalHostsThisMonth={totalHostsThisMonth}
                                totalGuestsThisMonth={totalGuestsThisMonth}
                            />
                            <div className="flex flex-col gap-4 py-4 md:gap-6 md:py-6">
                                <h1 className="text-2xl font-semibold mb-4  ml-5">
                                    Latest Users
                                </h1>
                                <DynamicDataTable
                                    data={latestUsers}
                                    columns={[
                                        "id",
                                        "name",
                                        "email",
                                        "role",
                                        "created_at",
                                    ]}
                                    editRoute="/users"
                                    deleteRoute="/users"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </SidebarInset>
        </SidebarProvider>
    );
}