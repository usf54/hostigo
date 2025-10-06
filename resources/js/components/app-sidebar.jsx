import * as React from "react"
import {
  ArrowUpCircleIcon,
  BathIcon,
  CalendarCheckIcon,
  LayoutDashboardIcon,
  HomeIcon,
  StarIcon,
  CreditCardIcon,
  SettingsIcon,
  UsersIcon,
} from "lucide-react"

import { NavMain } from "@/components/nav-main"
import { NavSecondary } from "@/components/nav-secondary"
import { NavUser } from "@/components/nav-user"
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from "@/components/ui/sidebar"
import { usePage } from '@inertiajs/react';


export function AppSidebar({
  ...props
}) {
  const { auth } = usePage().props;
  const user = auth?.user;

  const data = {
    user: {
      name: user?.name,
      email: user?.email,
      avatar: user?.avatar,
    },
    navMain: [
      {
        title: "Dashboard",
        url: "/dashboard",
        icon: LayoutDashboardIcon,
      },
      {
        title: "Amenities",
        url: "/amenities",
        icon: BathIcon,
      },
      {
        title: "Bookings",
        url: "/bookings",
        icon: CalendarCheckIcon,
      },
      {
        title: "Payments",
        url: "/payments",
        icon: CreditCardIcon,
      },
      {
        title: "Properties",
        url: "/properties",
        icon: HomeIcon,
      },
      {
        title: "Reviews",
        url: "/reviews",
        icon: StarIcon,
      },
      {
        title: "Users",
        url: "/users",
        icon: UsersIcon,
      },
    ],
    navSecondary: [
      {
        title: "Settings",
        url: "/settings",
        icon: SettingsIcon,
      },
    ],
  }

  return (
    <Sidebar collapsible="offcanvas" {...props}>
      <SidebarHeader>
        <SidebarMenu>
          <SidebarMenuItem>
            <SidebarMenuButton asChild className="data-[slot=sidebar-menu-button]:!p-1.5">
              <a href="/">
                <ArrowUpCircleIcon className="h-5 w-5" />
                <span className="text-base font-semibold">HostiGo</span>
              </a>
            </SidebarMenuButton>
          </SidebarMenuItem>
        </SidebarMenu>
      </SidebarHeader>
      <SidebarContent>
        <NavMain items={data.navMain} />      
        <NavSecondary items={data.navSecondary} className="mt-auto" />
      </SidebarContent>
      <SidebarFooter>
        <NavUser user={data.user} />
      </SidebarFooter>
    </Sidebar>
  );
}
