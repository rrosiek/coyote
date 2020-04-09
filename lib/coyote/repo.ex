defmodule Coyote.Repo do
  use Ecto.Repo,
    otp_app: :coyote,
    adapter: Ecto.Adapters.Postgres

  use Scrivener, page_size: 25
end
