defmodule Coyote.Uploads.Minute do
  use Ecto.Schema
  import Ecto.Changeset

  schema "minutes" do
    field :meeting_date, :naive_datetime

    timestamps()
  end

  @doc false
  def changeset(minute, attrs) do
    minute
    |> cast(attrs, [:meeting_date])
    |> validate_required([:meeting_date])
  end
end
